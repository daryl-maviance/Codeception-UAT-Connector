<?php

declare(strict_types=1);

namespace Tests\Api;

use Tests\Support\ApiTester;

final class CashinCest
{
    public $fixtures;

    public function __construct()
    {
        $this->fixtures = require codecept_data_dir('digitech_cashin_fixtures.php');
    }
    
    public function _before(ApiTester $I): void
    {
        // Code here will be executed before each test.
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->haveHttpHeader('x-api-version', $this->fixtures['x-api-version']);
        $I->haveHttpHeader('x-api-key', $this->fixtures['x-api-key']);

    }

    public function TestCashinPay(ApiTester $I): void
    {
        $I->wantTo('Make a cashin payment');
        $I->sendPost('/cashin/pay', $this->fixtures['payload']);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($this->fixtures['expected_response']);
    }
   
}
