<?php
//API Url
$url = 'https://mpc.getswish.net/qrg-swish/api/v1/prefilled';

//Initiate cURL.
$ch = curl_init($url);

//Encode the array into JSON.
$jsonDataEncoded = '{
  "payee": {
    "value": "%payee%",
    "editable": false
  },
  "message": {
    "value": "%message%",
    "editable": false
  },
  "amount": {
    "value": %amount%,
    "editable": false
  },
  "format": "png",
  "size": 320
}';


if (isset($_GET['payee'])) {
    $jsonDataEncoded = str_replace('%payee%', $_GET['payee'], $jsonDataEncoded);
} else {
    $jsonDataEncoded = str_replace('%payee%', '1231181189', $jsonDataEncoded);
}

if (isset($_GET['amount'])) {
    $jsonDataEncoded = str_replace('%amount%', $_GET['amount'], $jsonDataEncoded);
} else {
    $jsonDataEncoded = str_replace('%amount%', '100.0', $jsonDataEncoded);
}

if (isset($_GET['message'])) {
    $jsonDataEncoded = str_replace('%message%', $_GET['message'], $jsonDataEncoded);
} else {
    $jsonDataEncoded = str_replace('%message%', 'Test', $jsonDataEncoded);
}

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonDataEncoded))
);

//Execute the request
$result = curl_exec($ch);

header("Content-Type: image/png");
header("Content-Length: " . strlen($result));

echo $result;