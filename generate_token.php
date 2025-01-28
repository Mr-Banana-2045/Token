<?php
session_start();

function generateToken($ip) {
    return substr(md5($ip . time()), 0, 20);
}

if (!isset($_SESSION['token'])) {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $_SESSION['token'] = generateToken($user_ip);
}

header('Content-Type: application/json');
echo json_encode(['token' => $_SESSION['token']]);
?>
