<?php
function getRelatedModuleData($baseUrl, $session, $relatedModule, $recordId) {


    $query = "SELECT * FROM $relatedModule WHERE parent_id = '$recordId' OR contact_id = '$recordId';";


    $url = $baseUrl . '?operation=query&sessionName=' . urlencode($session) . '&query=' . urlencode($query);
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    

 

    
    if ($data && $data['success']) {
        return $data['result'];
    } else {
        return ['error' => $data['error']['message'] ?? 'Unknown error'];
    }
}


