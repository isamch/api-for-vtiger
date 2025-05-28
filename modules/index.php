<?php
// session_start();
header('Content-Type: application/json');

include __DIR__ . '/../config/config.php';
include __DIR__ . '/../helpers/relatedModulesFunction.php';
include __DIR__ . '/../helpers/users.php';
include __DIR__ . '/../auth/verifySession.php';




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


// echo json_encode(['userMap' => $userMap]);
// exit;

// Define the list of desired field labels
$desiredLabels = [
	"First Name",
	"Last Name",
	"Email",
	"Phone",
	"Organization Name",
	"Title",
	"Assigned To",
	"Mailing City",
	"Mailing Country"
];

$output = [];
foreach ($recordsData as $recordData) {
	$entry = [];
	foreach ($fields as $field) {
		// Ensure both field name and label are set before proceeding
		if (!isset($field['name']) || !isset($field['label'])) {
			continue;
		}

		// Filter fields based on the desired labels
		if (!in_array($field['label'], $desiredLabels, true)) {
			continue;
		}

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

			$fieldEntry['userMap'] = [ $recordData[$field['name']] => $userMap[$recordData[$field['name']]] ];

		
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

echo json_encode($output);
