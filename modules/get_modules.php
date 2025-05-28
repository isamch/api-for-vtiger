<?php
header('Content-Type: application/json');


include __DIR__ . '/../config/config.php';
include __DIR__ . '/../auth/verifySession.php'; 



$session = verifySession($baseUrl);




function getAllModules($session) {
    $url = 'http://localhost:8080/vtigercrm/webservice.php';

    $params = [
        'operation' => 'listtypes',
        'sessionName' => $session
    ];

    $apiUrl = $url . '?' . http_build_query($params);

    $response = file_get_contents($apiUrl);

    if ($response === false) {
        return ['success' => false, 'error' => 'API request failed'];
    }

    $result = json_decode($response, true);

    if (isset($result['success']) && $result['success']) {
        return ['success' => true, 'data' => $result['result']['types']];
    }

    return ['success' => false, 'error' => $result['error']['message'] ?? 'Unknown error'];
}

echo json_encode(getAllModules($session), JSON_PRETTY_PRINT);
