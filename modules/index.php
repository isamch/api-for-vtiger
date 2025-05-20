<?php

include __DIR__ . '/../config/config.php';
include __DIR__ . '/../helpers/relatedModulesFunction.php';
include __DIR__ . '/../helpers/users.php';

// Request session from login.php
$loginJson = file_get_contents('http://localhost:8080/vtigercrm/api/auth/login.php');
$login = json_decode($loginJson, true);

if (!isset($login['sessionName'])) {
  http_response_code(500);
  echo json_encode(['error' => 'Login failed']);
  exit;
}

$session = $login['sessionName'];

// Get module name (Contacts)
$moduleName = 'Contacts';

// Describe fields
$describeJson = file_get_contents("$baseUrl?operation=describe&sessionName=$session&elementType=$moduleName");
$describe = json_decode($describeJson, true);
if (!$describe || !$describe['success']) {
  http_response_code(500);
  die(json_encode(['error' => 'Describe failed']));
}
$fields = $describe['result']['fields'];

// Fetch all contacts
$query = "SELECT * FROM $moduleName;";
$queryUrl = "$baseUrl?operation=query&sessionName=$session&query=" . urlencode($query);
$recordsJson = file_get_contents($queryUrl);
$records = json_decode($recordsJson, true);
if (!$records || !$records['success']) {
  http_response_code(500);
  die(json_encode(['error' => 'Failed to fetch contacts']));
}
$recordsData = $records['result'];

// Get user map for assigned_user_id fields
$userMap = getUsers($baseUrl, $session);


$output = [];
foreach ($recordsData as $recordData) {
  $entry = [];
  foreach ($fields as $field) {
    if (!isset($field['name'])) continue;

    $typeName = $field['type']['name'] ?? 'string';
    $fieldEntry = [
      'fieldname' => $field['name'],
      'label' => $field['label'],
      'type' => $typeName,
      'value' => $recordData[$field['name']] ?? '',
      'mandatory' => !empty($field['mandatory']),
    ];

    if ($typeName === 'picklist' && isset($field['type']['picklistValues'])) {
      $fieldEntry['options'] = array_map(fn($o) => $o['value'], $field['type']['picklistValues']);
    }

    if ($field['name'] === 'assigned_user_id') {
      $fieldEntry['options'] = array_keys($userMap);
      $fieldEntry['userMap'] = $userMap;
    }

    $entry[] = $fieldEntry;
  }

  // Modules to get related data for each contact
  $relatedModules = ['Potentials', 'Documents', 'Activities'];
  // Fetch related data for this contact record
  $recordId = $recordData['id'];
  $relatedData = [];
  foreach ($relatedModules as $mod) {
    $relatedData[$mod] = getRelatedModuleData($baseUrl, $session, $mod, $recordId);
  }

  // Add related data to the contact entry
  $output[] = [
    'fields' => $entry,
    'related' => $relatedData,
  ];
}

header('Content-Type: application/json');
echo json_encode($output);
