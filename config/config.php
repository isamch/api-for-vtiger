<?php


$baseUrl = 'http://localhost:8080/vtigercrm/webservice.php';

function sendRequest($url, $postData = null) {
    $options = ['http' => ['header' => "Content-Type: application/x-www-form-urlencoded\r\n"]];
    if ($postData !== null) {
        $options['http']['method'] = 'POST';
        $options['http']['content'] = http_build_query($postData);
    }
    $context = stream_context_create($options);
    return file_get_contents($url, false, $context);
}
