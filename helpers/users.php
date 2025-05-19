<?php
function getUsers($baseUrl, $session)
{
  $query = "SELECT id, user_name FROM Users;";
  $queryUrl = "$baseUrl?operation=query&sessionName=$session&query=" . urlencode($query);
  $usersJson = file_get_contents($queryUrl);
  $users = json_decode($usersJson, true);
  if (!$users || !$users['success']) {
    return [];
  }
  $userMap = [];
  foreach ($users['result'] as $user) {
    $userMap[$user['id']] = $user['user_name'];
  }
  return $userMap;
}
