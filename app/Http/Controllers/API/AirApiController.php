<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TestXml;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AirApiController extends Controller
{
    public function getRoute(Request $request): JsonResponse
    {
        $result = [];

        if (!$request->request->has('file')) return $this->sendResponse('There is no xml file', []);

        $string = $request->request->get('file');

//        $testXml = new TestXml();
//        $string = $testXml->getXml();

        $new = simplexml_load_string($string);
        $con = json_encode($new);
        $newArr = json_decode($con, true);
        $maxSpentSeconds = 0;
        $maxSpentCity = '';

        foreach ($newArr as $key => $airs) {
            if ($key === 'AirSegments' && key_exists('AirSegment', $airs)) {
                foreach ($airs as $air) {
                    foreach ($air as $airKey => $airInfo) {
                        $arrival = $airInfo['Arrival']['@attributes'] ?? null;
                        $departure = $airInfo['Departure']['@attributes'] ?? null;
                        $city = $airInfo['Board']['@attributes']['City'] ?? '';

                        if (is_null($arrival) || is_null($departure) || $city === '') continue 2;

                        if (isset($air[$airKey - 1])) {
                            if ($air[$airKey - 1]['Off']['@attributes']['City'] === $city) {
                                $result['routes'][] = $city;
                            } else {
                                $result['breaks'][] = $city;
                            }

                            if (isset($air[$airKey + 1]) === false) {
                                $result['routes'][$airKey + 1] = $result['routes'][0];
                            }

                        } else {
                            $result['routes'][$airKey] = $city;
                        }

                        // Calculate finish point
                        $dateArrival = Carbon::parse($arrival['Date']);
                        $timeArrival = Carbon::parse($arrival['Time']);

                        $arrivalTime = $dateArrival->setTimeFrom($timeArrival);

                        $dateDeparture = Carbon::parse($departure['Date']);
                        $timeDeparture = Carbon::parse($departure['Time']);

                        $departureTime = $dateDeparture->setTimeFrom($timeDeparture);

                        $spentSeconds = Carbon::createFromTimestamp($arrivalTime->getTimestamp() - $departureTime->getTimestamp())->getTimestamp();

                        if ($maxSpentSeconds < $spentSeconds) {
                            $maxSpentSeconds = $spentSeconds;
                            $maxSpentCity = $airInfo['Board']['@attributes']['City'] ?? '';
                        }

                        $spentInterval = CarbonInterval::seconds($spentSeconds)->cascade()->forHumans();

                        $result['finishCity'] = $maxSpentCity;
                        $result['spentTimeInFinishCity'] = $spentInterval;
                    }
                }
            }
        }

        return $this->sendResponse('OK', $result);
    }

    private function sendResponse($message, $result): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $result
        ]);
    }
}