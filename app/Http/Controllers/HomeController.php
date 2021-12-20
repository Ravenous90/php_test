<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\AlliExpressSourceType;
use App\Services\ClientService;
use App\Services\DBLogger;
use DiDom\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Nubs\RandomNameGenerator\Alliteration;
use ParseCsv\Csv;
use phpDocumentor\Reflection\Types\Integer;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\Factory;
use React\Http\Browser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::all();
//        Redis::set('hel', 23);
//        $some = Redis::get('key');


        return view('home', [
            'message' => 1,
//            'clients' => $clients,
            'clients' => DB::table('clients')->paginate(2),
        ]);
    }

    public function saveClientFromFront()
    {
        $clientService = new ClientService(new DBLogger(), new AlliExpressSourceType());

        $clientService->saveClient();
    }
}
