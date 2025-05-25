<?php
// session_start();
header('Content-Type: application/json');

include __DIR__ . '/../config/config.php';
include __DIR__ . '/../auth/verifySession.php'; 


// Get JSON input
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Validate input
if (empty($input['id'])) {
  http_response_code(400);
  echo json_encode(['error' => 'Missing id in POST data']);
  exit;
}
$id = $input['id'];



$moduleName = 'Contacts';
$session = verifySession($baseUrl, 'Contacts');




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
