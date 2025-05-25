<?php

function getSessionName() {

	$input = json_decode(file_get_contents("php://input"), true);

    if (isset($input['sessionName'])) {
        return $input['sessionName'];
    }

    // If not found in JSON, try POST
    if (isset($_POST['sessionName'])) {
        return $_POST['sessionName'];
    }

    // If not found in POST, try GET
    if (isset($_GET['sessionName'])) {
        return $_GET['sessionName'];
    }

    // If sessionName is not found
    http_response_code(400);
    echo json_encode(['error' => 'sessionName is required']);
    exit;
}

function verifySession($baseUrl, $moduleName = 'Contacts') {
    $session = getSessionName();

    // Verify session validity using describe (or another appropriate operation)
    $checkSessionUrl = "$baseUrl?operation=describe&sessionName=$session&elementType=$moduleName";
    $response = sendRequest($checkSessionUrl);
    $result = json_decode($response, true);

    if (!$result || !$result['success']) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid or expired session']);
        exit;
    }

    return $session;
}
