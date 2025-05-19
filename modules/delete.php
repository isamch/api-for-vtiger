<?php
require_once __DIR__ . '/../config/config.php';

// Set response header
header('Content-Type: application/json');

// Get JSON input
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Validate input
if (empty($input['id'])) {
  http_response_code(400);
  echo json_encode(['error' => 'Missing id in POST data']);
  exit;
}

// Authenticate and get session
$loginJson = file_get_contents('http://localhost:8080/vtigercrm/api/auth/login.php');
$login = json_decode($loginJson, true);

if (empty($login['sessionName'])) {
  http_response_code(500);
  echo json_encode(['error' => 'Login failed']);
  exit;
}

$session = $login['sessionName'];
$id = $input['id'];

// Prepare API request data
$postData = [
  'operation'   => 'delete',
  'sessionName' => $session,
  'id'          => $id,
];

// Send API request
$responseJson = sendRequest($baseUrl, $postData);
$response = json_decode($responseJson, true);

// Handle response
if (!empty($response['success'])) {
  http_response_code(200);
  echo json_encode([
    'success' => true,
    'message' => 'Record deleted successfully.'
  ]);
} else {
  $errorMsg = $response['error']['message'] ?? 'Unknown error';
  http_response_code(500);
  echo json_encode(['error' => $errorMsg]);
}
