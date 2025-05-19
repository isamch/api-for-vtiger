<?php
function getRelatedModuleData($baseUrl, $session, $moduleName, $recordId) {
    switch ($moduleName) {
        case 'Potentials':
            $query = "SELECT * FROM Potentials WHERE related_to = '$recordId' OR contactid = '$recordId'";
            break;
        case 'Documents':
            $query = "SELECT vtiger_notes.* FROM vtiger_notes
                      JOIN vtiger_crmentityrel ON vtiger_crmentityrel.crmid = vtiger_notes.notesid
                      WHERE vtiger_crmentityrel.relcrmid = '$recordId'";
            break;
        case 'Activities':
            $query = "SELECT * FROM Activities WHERE parent_id = '$recordId' OR contact_id = '$recordId'";
            break;
        default:
            return ['error' => 'Unknown module'];
    }

    $url = $baseUrl . '?operation=query&sessionName=' . urlencode($session) . '&query=' . urlencode($query);
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    if ($data && $data['success']) {
        return $data['result'];
    } else {
        return ['error' => 'Failed to fetch'];
    }
}


