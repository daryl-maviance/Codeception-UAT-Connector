<?php

declare(strict_types=1);


namespace Tests\Api;

use Tests\Support\ApiTester;

final class CashoutCest
{
    public function _before(ApiTester $I): void
    {
        // Code here will be executed before each test.
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->haveHttpHeader('x-api-version','v1');
        $I->haveHttpHeader('x-api-key','TESTKEY');

    }

    public function TestHealth(ApiTester $I): void
    {
        // Write your tests here. All `public` methods will be executed as tests.
        $I->wantTo('Make sure  the  service is healthy');
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
        $I->seeResponseContainsJson(
            [
                'remote' =>[
                    'status' => 'OK',
                    'info' => 'OK'
                ]
            ]
        );
    }

    public function TestPing(ApiTester $I): void
    {
        $I->wantTo('check  the  avaibility of  the api');
        $I->sendGet('/ping');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
                'status' => 'string',
            ]
        );
        $I->seeResponseContainsJson(
            [
                'status' => 'OK'
            ]
        );
    }



    public function Testlookup (ApiTester $I): void
    {
        $I->wantTo('search  for  customer name');
        $cident = 'ok';
        $I->sendGet('/lookup?cident='.$cident);
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

    

    public function TestCashinPay(ApiTester $I): void
    {
        $I->wantTo('Make a cashout payment');
        $payload =[
            "cdata"=> "string",
          
            "customer"=> [
              "phone"=> "+23699255753",
              "email"=> "address@domain.com",
              "firstname"=> "John",
              "lastname"=> "Doe",
              "dob"=> "2001-05-17",
              "idDocumentNumber"=> "string",
              "idDocumentType"=> "string",
              "idDocumentCountryIso"=> "CM",
              "cdata"=> "string"
            ],
            
            "agent"=> [
              "agentId"=> "string",
              "ccId"=> "dae566",
              "agentName"=> "Daryl",
              "ccName"=> "Daryl Sarl",
              "lat"=> 85,
              "lng"=> 180
            ],
            "service" => "MOMO_CASHOUT",
            "callbackUrl"=> "https://www.smxobilpay.example.com",
            "destination"=> "079253755",
            "ptn"=> "BG",
            "amount"=> 1000
        ];
        $I->sendPost('/cashin/pay', $payload);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
               'status' => 'QUEUED'
            ]
        );
    }



   
    public function PaymentTest(ApiTester $I): void
    {
        $uuid = '9b38acce-ab25-486d-877e-73f0c18ebfb6';
        $I->wantTo('Get the status of a payment by payment reference id');
        $I->sendGet('/payment/'.$uuid);      
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
               'status' => 'INPROGRESS'
            ]
        );
    }

   
    public function BalanceTest(ApiTester $I): void
    {
        $I->wantTo('check the balance of the service');
        $I->sendGet('/balance');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
                'balance' => 'integer',
                
            ]
        );
        $I->seeResponseContainsJson(
            [
               'balance' => 0
            ]
        );
    }


   
    public function PaymentPurgeTest(ApiTester $I): void
    {
        $I->wantTo('Purge a payment by payment');
        $I->sendGet('/payment/purge');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
               'isPurged' => 'boolean',
            ]
        );
        $I->seeResponseContainsJson(
            [
               'isPurged' => true
            ]
        );
    }


    public function PaymentRefreshTest(ApiTester $I): void
    {
        $I->wantTo('trigger a deep check refresh');
        $uuid = '9b38acce-ab25-486d-877e-73f0c18ebfb6';
        $I->sendGet('/payment/'.$uuid.'/refresh');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                [
                    'status' => 'PENDING'
                 ]
            ]
        );
    }


    /**
     * @skip
     */
    public function Test(ApiTester $I): void
    {
        $I->wantTo('');
        $I->send('/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
               
            ]
        );
        $I->seeResponseContainsJson(
            [
               
            ]
        );
    }
}
