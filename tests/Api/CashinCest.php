<?php

declare(strict_types=1);


namespace Tests\Api;

use Tests\Support\AcceptanceTester;

final class CashinCest
{
    public function _before(AcceptanceTester $I): void
    {
        // Code here will be executed before each test.
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->haveHttpHeader('x-api-version','V1');
        $I->haveHttpHeader('x-api-key','TESTKEY');

    }

    public function tryToTest(AcceptanceTester $I): void
    {
        // Write your tests here. All `public` methods will be executed as tests.
    }
}
