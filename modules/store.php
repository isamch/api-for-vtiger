<?php

header('Content-Type: application/json');

include __DIR__ . '/../config/config.php';
include __DIR__ . '/../auth/verifySession.php'; 


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (!$input) {
  http_response_code(400);
  echo json_encode(['error' => 'Invalid JSON input']);
  exit;
}

if (!isset($input['moduleName'], $input['fields'])) {
  http_response_code(400);
  echo json_encode(['error' => 'Missing parameters: moduleName or fields']);
  exit;
}


$moduleName = $input['moduleName'];
$fieldsToCreate = $input['fields'];


$session = verifySession($baseUrl, 'Contacts');

$element = $fieldsToCreate;


$postData = [
  'operation' => 'create',
  'sessionName' => $session,
  'element' => json_encode($element),
  'elementType' => $moduleName
];


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
  echo json_encode(['error' => 'Failed to create record', 'details' => $response]);
  exit;
}

$result = json_decode($response, true);
if (!$result) {
  http_response_code(500);
  echo json_encode(['error' => 'Invalid response from API']);
  exit;
}

if (isset($result['success']) && $result['success']) {
  $newRecordId = $result['result']['id'] ?? null;

  if ($newRecordId) {
    $url = $baseUrl . "?operation=retrieve&sessionName=" . urlencode($session) . "&id=" . urlencode($newRecordId);
    $recordJson = file_get_contents($url);
    $record = json_decode($recordJson, true);

    echo json_encode(['success' => true, 'record' => $record]);
  } else {
    echo json_encode(['success' => true, 'message' => 'Record created but ID not returned', 'result' => $result]);
  }

} else {
  http_response_code(400);
  echo json_encode(['error' => 'Create failed', 'details' => $result]);
}
