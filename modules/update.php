<?php

header('Content-Type: application/json');

include __DIR__ . '/../config/config.php';
include __DIR__ . '/../auth/verifySession.php'; 


// Receive JSON data from POST
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);


if (!$input) {
  http_response_code(400);
  echo json_encode(['error' => 'Invalid JSON input']);
  exit;
}

// Check for required fields
if (!isset($input['moduleName'], $input['recordId'], $input['fields'])) {
  http_response_code(400);
  echo json_encode(['error' => 'Missing parameters: moduleName, recordId, or fields']);
  exit;
}


$moduleName = $input['moduleName'];

$session = verifySession($baseUrl);


$recordId = $input['recordId'];
$fieldsToUpdate = $input['fields'];

// Build update element
$element = $fieldsToUpdate;
$element['id'] = $recordId;

// Prepare POST data
$postData = [
  'operation' => 'update',
  'sessionName' => $session,
  'element' => json_encode($element),
];


// Send request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
  http_response_code($httpCode);
  echo json_encode(['error' => 'Failed to update record', 'details' => $response]);
  exit;
}

$result = json_decode($response, true);
if (!$result) {
  http_response_code(500);
  echo json_encode(['error' => 'Invalid response from API']);
  exit;
}

if (isset($result['success']) && $result['success']) {
  $url = "http://localhost:8080/vtigercrm/api/modules/show.php?id=" . urlencode($recordId) . "&sessionName=" . urlencode($session) . "&moduleName=" . urlencode($moduleName);

  $contactJson = file_get_contents($url);
  $contact = json_decode($contactJson, true);

  echo json_encode(['success' => true, 'contact' => $contact]);
} else {
  http_response_code(400);
  echo json_encode(['error' => 'Update failed', 'details' => $result]);
}
