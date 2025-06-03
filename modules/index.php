<?php
// session_start();
header('Content-Type: application/json');

include __DIR__ . '/../config/config.php';
include __DIR__ . '/../helpers/relatedModulesFunction.php';
include __DIR__ . '/../helpers/users.php';
include __DIR__ . '/../auth/verifySession.php';


include __DIR__ . '/../helpers/modules/modulesData.php';


$moduleName = $_GET['moduleName'];

$session = verifySession($baseUrl);



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
	die(json_encode(['error' => "Failed to fetch $moduleName"]));
}

$recordsData = $records['result'];




// Get user map for assigned_user_id fields
$userMap = getUsers($baseUrl, $session);


$moduleFields = getModuleData($moduleName);


$output = [];
foreach ($recordsData as $recordData) {
	$entry = [];
	foreach ($fields as $field) {
		// Ensure both field name and label are set before proceeding


		// check if field is mandatory
		if (!$field['mandatory']) {

			// filter by summary fields
			if (!in_array($field['name'], $moduleFields['summaryFields'], false)) {
				continue;
			}

			// filter by data type
			if (in_array($field['type']['name'], $moduleFields['excludedTypes'], false)) {
				continue;
			}
		}




		$typeName = $field['type']['name'] ?? 'string';
		$fieldEntry = [
			'fieldname' => $field['name'],
			'label' => $field['label'],
			'type' => $typeName,
			'value' => ($recordData[$field['name']] ?? '') === '1' ? 'yes' : (($recordData[$field['name']] ?? '') === '0' ? 'no' : ($recordData[$field['name']] ?? '')),
			'mandatory' => !empty($field['mandatory']),
		];

		if ($typeName === 'picklist' && isset($field['type']['picklistValues'])) {
			$fieldEntry['options'] = array_map(fn($o) => $o['value'], $field['type']['picklistValues']);
		}

		if ($field['name'] === 'modifiedby') {
			$fieldEntry['value'] = $userMap[$recordData[$field['name']]];
		}

		if ($field['name'] === 'assigned_user_id') {
			$fieldEntry['options'] = array_keys($userMap);
			$fieldEntry['userMap'] = [$recordData[$field['name']] => $userMap[$recordData[$field['name']]]];
		}

		$entry[] = $fieldEntry;
	}






	// Add related data to the contact entry
	$output[] = [
		'fields' => $entry,
		'relatedModules' => $moduleFields['relatedModules'],
	];
}

echo json_encode($output);
