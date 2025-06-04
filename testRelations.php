<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "🚀 Script started<br>";

require_once(__DIR__ . '/../include/utils/utils.php');
require_once(__DIR__ . '/../vtlib/Vtiger/Module.php');

$moduleName = 'Contacts';

$module = Vtiger_Module::getInstance($moduleName);

if (!$module) {
    die("❌ Module $moduleName not found.");
} else {
    echo "✅ Module $moduleName loaded successfully.<br>";
}

$relations = $module->getRelations();

if (empty($relations)) {
    echo "⚠️ No related modules found for $moduleName.";
} else {
    echo "Related modules for $moduleName:<br><ul>";
    foreach ($relations as $relation) {
        echo "<li>" . $relation->getName() . "</li>";
    }
    echo "</ul>";
}
