<?php
include __DIR__ . '/../config/config.php';

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
  http_response_code(500);
  echo json_encode(['error' => 'Login failed']);
  exit;
}

header('Content-Type: application/json');
echo json_encode(['sessionName' => $login['result']['sessionName']]);
