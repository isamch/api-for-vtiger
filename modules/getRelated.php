<?php
header('Content-Type: application/json');

include __DIR__ . '/../config/config.php';
include __DIR__ . '/../helpers/relatedModulesFunction.php';
include __DIR__ . '/../auth/verifySession.php';
include __DIR__ . '/../helpers/modules/modulesData.php';

// Verify required parameters
if (!isset($_GET['moduleName']) || !isset($_GET['id']) || !isset($_GET['relatedModule'])) {
    http_response_code(400);
    die(json_encode([
        'success' => false,
        'error' => 'Missing required parameters: moduleName, id, and relatedModule'
    ]));
}

$moduleName = $_GET['moduleName'];
$recordId = $_GET['id'];
$relatedModule = $_GET['relatedModule'];

// Verify session
$session = verifySession($baseUrl);

// Get module data to verify if the related module is valid
$moduleData = getModuleData($moduleName);

// Check if the requested related module is valid for this module
if (!isset($moduleData['relatedModules']) || !in_array($relatedModule, $moduleData['relatedModules'])) {
    http_response_code(400);
    die(json_encode([
        'success' => false,
        'error' => "Invalid related module. '$relatedModule' is not related to '$moduleName'"
    ]));
}

// Get the related module data
$relatedData = getRelatedModuleData($baseUrl, $session, $relatedModule, $recordId);

// Return the response
if (isset($relatedData['error'])) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $relatedData['error']
    ]);
} else {
    echo json_encode([
        'success' => true,
        'data' => $relatedData
    ]);
}
