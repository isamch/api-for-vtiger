<?php

require_once __DIR__ . '/../config/database.php';

function getContactAttachmentsDirect($attachmentsid) {
    try {
        $dbConnection = getDatabaseConnection();
        
        $query = "SELECT path, storedname, name FROM vtiger_attachments WHERE attachmentsid = ?";
        
        $stmt = $dbConnection->prepare($query);
        $stmt->execute([$attachmentsid]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("Error fetching attachments: " . $e->getMessage());
        return [];
    }
}