<?php

declare(strict_types=1);

namespace Tests\Api;

use Tests\Support\ApiTester;

final class CommonCest
{
    
    public $fixtures;
    
    public function __construct()
    {
        $this->fixtures = require codecept_data_dir('digitech_common_fixtures.php');
    }

    public function _before(ApiTester $I): void
    {
         $I->haveHttpHeader('Content-Type', 'application/json');
         $I->haveHttpHeader('Accept', 'application/json');
    }

   
    public function TestHealth(ApiTester $I): void
    {
        // Write your tests here. All `public` methods will be executed as tests.
        $I->wantTo('Make sure  the  service is healthy');
        $I->haveHttpHeader('x-api-version', $this->fixtures['x-api-version']);
        $I->haveHttpHeader('x-api-key', $this->fixtures['x-api-key']);
        $I->sendGet('/health');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
                'time' => 'string',
                'workload' => [
                    'pending' => 'integer',
                    'success' => 'integer',
                    'error' => 'integer'
                ],
                'remote' =>[
                    'status' => 'string',
                    'info' => 'string'
                ],
                'components' => [
                    [
                        'name' => 'string',
                        'status' => 'string',
                        'info' => 'string'
                    ]
                ]

            ]
        );
        $I->seeResponseContainsJson($this->fixtures['healthResponse'] );
    }


    public function TestPing(ApiTester $I): void
    {
        $I->wantTo('check  the  avaibility of  the api');
        $I->haveHttpHeader('x-api-version', $this->fixtures['x-api-version']);
        $I->haveHttpHeader('x-api-key', $this->fixtures['x-api-key']);
        $I->sendGet('/ping');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
                'status' => 'string',
            ]
        );
        $I->seeResponseContainsJson($this->fixtures['pingResponse'] );
    }


    public function Testlookup (ApiTester $I): void
    {
        $I->wantTo('search  for  customer name');
        $I->haveHttpHeader('x-api-version', $this->fixtures['x-api-version']);
        $I->haveHttpHeader('x-api-key', $this->fixtures['x-api-key']);
        $I->sendGet('/lookup?cident='.$this->fixtures['lookupData']['cident']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
               'found' => 'boolean',
               'entry' =>[
                    'cident' => 'string',
                    'cname'=>'string',
               ]
            ]
        );
    }

    
    public function TestNoApiKey(ApiTester $I): void
    {
        $I->wantTo('check  the  health of  the api without api key');
        $I->haveHttpHeader('x-api-version', $this->fixtures['x-api-version']);
        $I->sendGet('/health');
        $I->seeResponseCodeIs(401);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($this->fixtures['noApiKeyResponse'] );

    }


    public function TestNoApiVersion(ApiTester $I): void
    {
        $I->wantTo('check  the  health of  the api without api version');
        $I->haveHttpHeader('x-api-key', $this->fixtures['x-api-key']);
        $I->sendGet('/health');
        $I->seeResponseCodeIs(401);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($this->fixtures['noApiVersionResponse'] );

    }

   
    public function ValidPaymentStatusTest(ApiTester $I): void
    {

        $I->wantTo('Get the status of a payment by existing payment reference id');
        $I->haveHttpHeader('x-api-version', $this->fixtures['x-api-version']);
        $I->haveHttpHeader('x-api-key', $this->fixtures['x-api-key']);
        $I->sendGet('/payment/'.$this->fixtures['paymentStatusData']['valid']['uuid']);      
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
               'status' => 'string'
            ]
        );

    }


    public function InvalidPaymentStatusTest(ApiTester $I): void
    {

        $I->wantTo('Does not get the status of a payment with non existant payment reference id');
        $I->haveHttpHeader('x-api-version', $this->fixtures['x-api-version']);
        $I->haveHttpHeader('x-api-key', $this->fixtures['x-api-key']);
        $I->sendGet('/payment/'.$this->fixtures['paymentStatusData']['invalid']['uuid']);      
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($this->fixtures['paymentStatusData']['invalid']['response'] );
    }


   
    public function BalanceTest(ApiTester $I): void
    {
        $I->wantTo('check the balance of the service');
        $I->haveHttpHeader('x-api-version', $this->fixtures['x-api-version']);
        $I->haveHttpHeader('x-api-key', $this->fixtures['x-api-key']);
        $I->sendGet('/balance');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
                'balance' => 'integer',
                
            ]
        );
        $I->seeResponseContainsJson($this->fixtures['balanceResponse'] );

    }


   
    public function PaymentPurgeTest(ApiTester $I): void
    {
        $I->wantTo('Purge a payment');
        $I->haveHttpHeader('x-api-version', $this->fixtures['x-api-version']);
        $I->haveHttpHeader('x-api-key', $this->fixtures['x-api-key']);
        $I->sendPost('/payment/purge');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
               'isPurged' => 'boolean',
            ]
        );
        $I->seeResponseContainsJson($this->fixtures['paymentPurgeResponse'] );

    }


    public function PaymentRefreshTest(ApiTester $I): void
    {
        $I->wantTo('trigger a deep check refresh');        $I->haveHttpHeader('x-api-version','v1');
        $I->haveHttpHeader('x-api-version', $this->fixtures['x-api-version']);
        $I->haveHttpHeader('x-api-key', $this->fixtures['x-api-key']);
        $uuid = '9b38acce-ab25-486d-877e-73f0c18ebfb6';
        $I->sendPost('/payment/'.$this->fixtures['paymentStatusData']['valid']['uuid'].'/refresh');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
                [
                    'status' => 'string'
                 ]
            ]
        );
    }
}
