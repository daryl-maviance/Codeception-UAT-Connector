<?php 
return[
    'x-api-version' => 'v1',
    'x-api-key' => 'TESTKEY',

    'payload' =>[
        "cdata"=> "some data",
      
        "customer"=> [
          "phone"=> "+23699255753",
          "email"=> "nfoye@domain.com",
          "firstname"=> "Johnathan",
          "lastname"=> "Daryl charisma",
          "dob"=> "2001-05-17",
          "idDocumentNumber"=> "1234",
          "idDocumentType"=> "doc",
          "idDocumentCountryIso"=> "CM",
          "cdata"=> "some string"
        ],
        
        "agent"=> [
          "agentId"=> "44ds5",
          "ccId"=> "dae566",
          "agentName"=> "Daryl",
          "ccName"=> "Daryl Sarl",
          "lat"=> 85,
          "lng"=> 180
        ],
        "service" => "MOMO_CASHOUT",
        "callbackUrl"=> "https://www.smxobilpay.example.com",
        "destination"=> "079253799",
        "ptn"=> "BIGBG",
        "amount"=> 3000
    ],

    'expected_response' => [
        'status' => 'QUEUED'
    ]

]
?>