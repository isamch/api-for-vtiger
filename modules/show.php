<?php
header('Content-Type: application/json');

include __DIR__ . '/../config/config.php';
include __DIR__ . '/../helpers/relatedModulesFunction.php';
include __DIR__ . '/../helpers/users.php';
include __DIR__ . '/../auth/verifySession.php'; 



$moduleName = $_GET['moduleName'];

$session = verifySession($baseUrl, 'Contacts');


// === VERIFY ID PARAMETER ===
if (!isset($_GET['id'])) {
  http_response_code(400);
  echo json_encode(['error' => 'Missing id parameter']);
  exit;
}

$id = $_GET['id'];

// === GET CONTACT DATA BY ID ===
$url = "$baseUrl?operation=retrieve&sessionName=$session&elementType=$moduleName&id=" . urlencode($id);
$contactJson = file_get_contents($url);
$contact = json_decode($contactJson, true);

if (!$contact || !$contact['success']) {
  http_response_code(404);
  echo json_encode(['error' => 'Contact not found']);
  exit;
}

$contactData = $contact['result'];

// === GET FIELD DESCRIPTIONS ===
$describeJson = file_get_contents("$baseUrl?operation=describe&sessionName=$session&elementType=$moduleName");
$describe = json_decode($describeJson, true);

if (!$describe || !$describe['success']) {
  http_response_code(500);
  echo json_encode(['error' => 'Describe failed']);
  exit;
}

$fields = $describe['result']['fields'];
// Get user map for assigned_user_id fields
$userMap = getUsers($baseUrl, $session);

// === BUILD OUTPUT FOR THE SINGLE CONTACT ===
$output = [];
foreach ($fields as $field) {
  if (!isset($field['name'])) continue;

  $typeName = $field['type']['name'] ?? 'string';
  $fieldEntry = [
    'fieldname' => $field['name'],
    'label' => $field['label'],
    'type' => $typeName,
    'value' => $contactData[$field['name']] ?? '',
    'mandatory' => !empty($field['mandatory']),
  ];

  if ($typeName === 'picklist' && isset($field['type']['picklistValues'])) {
    $fieldEntry['options'] = array_map(fn($o) => $o['value'], $field['type']['picklistValues']);
  }

  if ($field['name'] === 'assigned_user_id') {
    $fieldEntry['options'] = array_keys($userMap);
    $fieldEntry['userMap'] = $userMap;
  }

  $output[] = $fieldEntry;
}




$relatedModules = ['Potentials', 'Documents', 'Activities'];
$relatedData = [];

foreach ($relatedModules as $mod) {
  $relatedData[$mod] = getRelatedModuleData($baseUrl, $session, $mod, $id);
}


echo json_encode([
  'fields' => [$output],
  'related' => [$relatedData]
]);
