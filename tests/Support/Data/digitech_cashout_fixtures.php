<?php 
return[
    'x-api-version' => 'v1',
    'x-api-key' => 'TESTKEY',
    
    'payload' =>[
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
    ],

    'expected_response' => [
        'status' => 'QUEUED'
    ]

]
?>