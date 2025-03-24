<?php 
return[
      'x-api-version' => 'v1',
      'x-api-key' => 'TESTKEY',

      'payload' =>[
          "cdata"=> "some text",
        
          "customer"=> [
            "phone"=> "+23699255753",
            "email"=> "address@mav.com",
            "firstname"=> "Johnny",
            "lastname"=> "Dilan",
            "dob"=> "2004-05-17",
            "idDocumentNumber"=> "4003",
            "idDocumentType"=> "doc",
            "idDocumentCountryIso"=> "CM",
            "cdata"=> "some other data"
          ],
          
          "agent"=> [
            "agentId"=> "dsd6515",
            "ccId"=> "dae566",
            "agentName"=> "Dewilde",
            "ccName"=> "Dewilde Sarl",
            "lat"=> 85,
            "lng"=> 180
          ],

          "service" => "MOMO_CASHIN",
          "callbackUrl"=> "https://www.smxobilpay.example.com",
          "destination"=> "079253722",
          "ptn"=> "SMALLBG",
          "amount"=> 12000
      ],

      'expected_response' => [
          'status' => 'QUEUED'
      ]
]
?>