<?php

function getQuickFields($baseUrl, string $moduleName, string $session)
{

  $query = "SELECT f.fieldname, t.name AS module 
            FROM vtiger_field f
            JOIN vtiger_tab t ON f.tabid = t.tabid
            WHERE f.quickcreate = 0
              AND t.name = '$moduleName'
            ORDER BY f.fieldlabel";



  $url = $baseUrl . '?operation=query&sessionName=' . urlencode($session) . '&query=' . urlencode($query);
  $json = file_get_contents($url);
  $data = json_decode($json, true);


  return $data;
  // if ($data && $data['success']) {
  //   return $data['result'];

  // } else {

  //   return ['error' => 'Failed to fetch'];
  // }
}
