<?php

namespace Tests\Feature;

use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_first_name()
    {
        $controller = new HomeController();
        $testCasePos = 'All Fola';
        $testCaseNeg = '';
        $testCaseNeg2 = 21;

        $controller->getFirstName($testCasePos);

        $this->assertEquals('All', $controller->getFirstName($testCasePos));
        $this->assertEquals('', $controller->getFirstName($testCaseNeg));
        $this->assertEquals('', $controller->getFirstName($testCaseNeg2));
    }
}
