<?php
// session_start();

header('Content-Type: application/json');

include __DIR__ . '/../config/config.php';


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

$username = $input['username'] ?? null;
$accessKey = $input['accessKey'] ?? null;

if (!$username || !$accessKey) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing username or accessKey']);
    exit;
}

$challengeJson = sendRequest("$baseUrl?operation=getchallenge&username=$username");
$challenge = json_decode($challengeJson, true);

if (!$challenge['success']) {
    http_response_code(500);
    echo json_encode(['error' => 'Challenge failed']);
    exit;
}

$token = $challenge['result']['token'];
$generatedKey = md5($token . $accessKey);

$postData = [
    'operation' => 'login',
    'username' => $username,
    'accessKey' => $generatedKey,
];

$loginJson = sendRequest($baseUrl, $postData);
$login = json_decode($loginJson, true);

if (!$login['success']) {
    http_response_code(401);
    echo json_encode(['error' => 'Wrong username or accesskey']);
    exit;
}

// $_SESSION['sessionName'] = $login['result']['sessionName'];

echo json_encode(['Auth User' => $login['result']]);
// echo json_encode(['sessionName' => $login['result']['sessionName']]);
