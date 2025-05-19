<?php
header('Content-Type: application/json; charset=utf-8');

include __DIR__ . '/../config/config.php';

// استقبال بيانات JSON من POST
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (!$input) {
  http_response_code(400);
  echo json_encode(['error' => 'Invalid JSON input']);
  exit;
}

if (!isset($input['moduleName'], $input['recordId'], $input['fields'])) {
  http_response_code(400);
  echo json_encode(['error' => 'Missing parameters: moduleName, recordId, or fields']);
  exit;
}

$moduleName = $input['moduleName'];
$recordId = $input['recordId'];
$fieldsToUpdate = $input['fields']; // هذا مصفوفة associative [ 'fieldname' => 'value', ... ]

// ** 1. نحتاج لجلسة (sessionName) أولاً - ممكن تعيد استخدام نفس طريقة login.php **
$loginJson = file_get_contents('http://localhost:8080/vtigercrm/api/auth/login.php');
$login = json_decode($loginJson, true);

if (!isset($login['sessionName'])) {
  http_response_code(500);
  echo json_encode(['error' => 'Login failed']);
  exit;
}
$session = $login['sessionName'];

// ** 2. بناء بيانات التحديث (POST) حسب API vtiger **
// vtiger API عادة يستقبل بيانات على شكل JSON مع حقل "element" يحتوي على السجل
// حسب توثيق vtiger، نحتاج على الأقل id و الحقول الجديدة

$element = $fieldsToUpdate;
$element['id'] = $recordId;

// بناء بيانات POST (form-urlencoded)
$postData = [
  'operation' => 'update',
  'sessionName' => $session,
  'element' => json_encode($element),
];

// إرسال الطلب باستخدام cURL (أفضل من file_get_contents للـ POST)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
  http_response_code($httpCode);
  echo json_encode(['error' => 'Failed to update record', 'details' => $response]);
  exit;
}

$result = json_decode($response, true);
if (!$result) {
  http_response_code(500);
  echo json_encode(['error' => 'Invalid response from API']);
  exit;
}

if (isset($result['success']) && $result['success']) {
  $url = "http://localhost:8080/vtigercrm/api/modules/show.php?id=" . urlencode($recordId);
  $contactJson = file_get_contents($url);
  $contact = json_decode($contactJson, true);

  echo json_encode(['success' => true, 'contact' => $contact]);

} else {
  http_response_code(400);
  echo json_encode(['error' => 'Update failed', 'details' => $result]);
}
