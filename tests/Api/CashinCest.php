<?php

declare(strict_types=1);


namespace Tests\Api;

use Tests\Support\ApiTester;

final class CashinCest
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
        $I->wantTo('Make a cashin payment');
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
            "service" => "MOMO_CASHIN",
            "callbackUrl"=> "https://www.smxobilpay.example.com",
            "destination"=> "079255755",
            "ptn"=> "BG",
            "amount"=> 1000
        ];
        $I->sendPost('/cashin/pay',);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
               'status' => 'QUEUED'
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
