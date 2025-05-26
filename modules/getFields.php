<?php
header('Content-Type: application/json');

include __DIR__ . '/../config/config.php';
include __DIR__ . '/../auth/verifySession.php'; 


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

$moduleName = $input['moduleName'] ?? 'Contacts';



try {
	$session = verifySession($baseUrl, $moduleName);

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
	echo json_encode(['fields' => $fields]);

} catch (Exception $e) {

	http_response_code(500);
	echo json_encode([
		'error' => $e->getMessage(),
		'details' => 'An error occurred while fetching field descriptions'
	]);
	exit;
}
