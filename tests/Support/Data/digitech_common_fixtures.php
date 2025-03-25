<?php 
return[
        'x-api-version' => 'v1',
        'x-api-key' => 'TESTKEY',

        'lookupData'=>[
            'cident' => 'ok'
        ],

        'paymentStatusData'=>[
            'valid' => [
                'uuid' => '9a43c843-8ab2-4e6b-a984-4b010a174c42'
            ],
            'invalid' =>[
                'uuid' => '9b38acce-ab25-486d-877e-73f0c18ebfb6'  ,
                'response' =>[
                    'code'=> 703100,
                    'message'=>'Payment with specified uuid does not exist',
                    'devMessage'=>'Payment with specified uuid does not exist'
                ]
            ]
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