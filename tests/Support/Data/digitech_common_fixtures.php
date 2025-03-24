<?php 
return[
        'x-api-version' => 'v1',
        'x-api-key' => 'TESTKEY',

        'lookupData'=>[
            'cident' => 'ok'
        ],

        'paymentStatusData'=>[
            'valid_uuid' => '18744203-bb39-4481-be0c-61ec413f9e48',
            'invalid_uuid' => '9b38acce-ab25-486d-877e-73f0c18ebfb6'
        ],

        'healthResponse' => [
          'remote' =>[
                'status' => 'OK',
                'info' => 'OK'
            ]
        ],

        'pingResponse'=>[
          'status' => 'OK'
        ],

        'noApiKeyResponse'=>[
          'code' => 702401,
          'message' => 'The api key is invalid: '
        ],

        'noApiVersionResponse'=>[
          'code' => 702010,
          'message' => 'the specified version is not supported by this api: '
        ],

        'balanceResponse' =>[
          'balance' => 0
        ],

        'paymentPurgeResponse'=>[
          'isPurged' => true,
        ]
]
?>