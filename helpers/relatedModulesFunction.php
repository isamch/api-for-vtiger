<?php
function getRelatedModuleData($baseUrl, $session, $relatedModule, $recordId) {
    // First check if there are any related records
    $query = "SELECT * FROM $relatedModule WHERE parent_id = '$recordId' OR contact_id = '$recordId';";
    $url = $baseUrl . '?operation=query&sessionName=' . urlencode($session) . '&query=' . urlencode($query);
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    // If there's an error or no data, return early
    if (!$data || !$data['success']) {
        return ['error' => $data['error']['message'] ?? 'Unknown error'];
    }

    // If no records found, return empty array
    if (empty($data['result'])) {
        return [];
    }

    // Get users for assigned_user_id field
    $userQuery = "SELECT id, user_name FROM Users;";
    $userUrl = $baseUrl . '?operation=query&sessionName=' . urlencode($session) . '&query=' . urlencode($userQuery);
    $userJson = file_get_contents($userUrl);
    $userData = json_decode($userJson, true);
    
    $userMap = [];
    if ($userData && $userData['success'] && !empty($userData['result'])) {
        foreach ($userData['result'] as $user) {
            $userMap[$user['id']] = $user['user_name'];
        }
    }

    // Only get field descriptions if we have records
    $describeJson = file_get_contents("$baseUrl?operation=describe&sessionName=$session&elementType=$relatedModule");
    $describe = json_decode($describeJson, true);
    
    if (!$describe || !$describe['success']) {
        return ['error' => 'Failed to get field descriptions'];
    }
    
    $fields = $describe['result']['fields'];
    $fieldMap = [];
    foreach ($fields as $field) {
        $fieldMap[$field['name']] = [
            'label' => $field['label'],
            'type' => $field['type']['name'] ?? 'string',
            'mandatory' => !empty($field['mandatory'])
        ];
    }

    // Format the records with field information
    $result = [];
    foreach ($data['result'] as $record) {
        $formattedRecord = [];
        foreach ($record as $fieldname => $value) {
            if (isset($fieldMap[$fieldname])) {
                $formattedField = [
                    'fieldname' => $fieldname,
                    'label' => $fieldMap[$fieldname]['label'],
                    'type' => $fieldMap[$fieldname]['type'],
                    'value' => $value === '1' ? 'yes' : ($value === '0' ? 'no' : $value),
                    'mandatory' => $fieldMap[$fieldname]['mandatory']
                ];

                // Add user mapping for assigned_user_id and modifiedby fields
                if (($fieldname === 'assigned_user_id' || $fieldname === 'modifiedby') && !empty($userMap)) {
                    $formattedField['options'] = array_keys($userMap);
                    $formattedField['userMap'] = $userMap;
                }

                $formattedRecord[] = $formattedField;
            }
        }
        $result[] = $formattedRecord;
    }
    return $result;
}


