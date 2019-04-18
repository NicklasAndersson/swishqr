<?php
$url = '{ "version" : 1, "payee" : { "value" : "%payee%" }, "amount" : { "value" : %amount% }, "message" : { "value" : "%message%", "editable" : false }}';

if (isset($_GET['payee'])) {
    $url = str_replace('%payee%', $_GET['payee'], $url);
} else {
    $url = str_replace('%payee%', '1231181189', $url);
}

if (isset($_GET['amount'])) {
    $url = str_replace('%amount%', $_GET['amount'], $url);
} else {
    $url = str_replace('%amount%', '100', $url);
}

if (isset($_GET['message'])) {
    $url = str_replace('%message%', $_GET['message'], $url);
} else {
    $url = str_replace('%message%', 'Test', $url);
}

$url = 'swish://payment?data=' . urlencode($url);

header('Location: '. $url);
die();