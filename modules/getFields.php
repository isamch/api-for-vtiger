<?php
header('Content-Type: application/json');

include __DIR__ . '/../config/config.php';
include __DIR__ . '/../auth/verifySession.php'; 
include __DIR__ . '/../helpers/users.php';

$moduleName = $_GET['moduleName'];

$desiredFields = [
	"imagename",
	"contact_no",
	"leadsource",
	"modifiedtime"
];

try {
	$session = verifySession($baseUrl);

	$describeJson = @file_get_contents("$baseUrl?operation=describe&sessionName=$session&elementType=$moduleName");
  
	if ($describeJson === false) {
		throw new Exception('Failed to fetch field descriptions');
	}

	$describe = json_decode($describeJson, true);
	if (json_last_error() !== JSON_ERROR_NONE) {
		throw new Exception('Invalid JSON response');
	}

	if (!$describe || !$describe['success']) {
		throw new Exception('Describe operation failed');
	}

	$fields = $describe['result']['fields'];
	
	// Get users for assigned_to field
	$users = getUsers($baseUrl, $session);
	
	// Filter to exclude the specified fields and enhance assigned_to field
	$filteredFields = array_values(array_filter($fields, function($field) use ($desiredFields) {
		return !in_array($field['name'], $desiredFields);
	}));

	// Add users as options for assigned_to field
	foreach ($filteredFields as &$field) {
		if ($field['name'] === 'assigned_user_id') {
			$field['type']['picklistValues'] = array_map(function($id, $name) {
				return ['value' => $id, 'label' => $name];
			}, array_keys($users), array_values($users));
		}
	}

	echo json_encode(['fields' => $filteredFields]);

} catch (Exception $e) {
	http_response_code(500);
	echo json_encode([
		'error' => $e->getMessage(),
		'details' => 'An error occurred while fetching field descriptions'
	]);
	exit;
}
