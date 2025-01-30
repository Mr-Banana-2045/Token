<?php
session_start();

function generateToken($id) {
    return substr(md5($id . time()), 0, 20);
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $arraytoken = [];
    if (file_exists('tokens.json')) {
        $json = file_get_contents('tokens.json');
        $arraytoken = json_decode($json, true);
    }

    $exists = false;
    foreach ($arraytoken as $tokenData) {
        if ($tokenData['user'] === $user_id || $tokenData['device'] === $_SERVER['HTTP_USER_AGENT']) {
            $exists = true;
            break;
        }
    }

    if ($exists) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Token already exists for this user ID']);
    } else {
        $token = generateToken($user_id);
        $_SESSION['token'] = $token;
        $maxId = 0;
        foreach ($arraytoken as $tokenData) {
            if ($tokenData['id'] > $maxId) {
                $maxId = $tokenData['id'];
            }
        }
        $i = $maxId + 1;
        $data = [
            'id' => $i,
            'user' => $user_id,
            'token' => $token,
            'device' => $_SERVER['HTTP_USER_AGENT']
        ];
        $arraytoken[] = $data;
        file_put_contents('tokens.json', json_encode($arraytoken, JSON_PRETTY_PRINT));

        header('Content-Type: application/json');
        echo json_encode(['token' => $token]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'User ID is required']);
    exit;
}
?>
