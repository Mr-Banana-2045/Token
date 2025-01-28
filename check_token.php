<?php
session_start();
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $valid_tokens = [
       'ad5225081d'
    ];
header('Content-Type: application/json');
if (in_array($token, $valid_tokens)) {
    $resp = [
    'text' => 'Successful',
    'out' => '<pre style="background:green;"></pre>'
    ];
} else {
    $resp = ['text' => 'Unsuccessful',
    'out' => '<pre style="background:red;"></pre>'
    ];
}
echo json_encode($resp);
} else {
    echo "Token not provided";
}
?>
