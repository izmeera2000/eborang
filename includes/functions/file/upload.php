<?php


function uploadFile($fileInputName, $targetDir = "uploads/", $allowedTypes = ['jpg', 'png', 'jpeg', 'pdf'], $maxSizeMB = 5) {
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'No file uploaded or upload error.'];
    }

    $file = $_FILES[$fileInputName];
    $fileName = basename($file["name"]);
    $fileSize = $file["size"];
    $fileTmp  = $file["tmp_name"];
    $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $maxSizeBytes = $maxSizeMB * 1024 * 1024;

    // Validate file extension
    if (!in_array($fileExt, $allowedTypes)) {
        return ['success' => false, 'message' => "Invalid file type. Allowed: " . implode(', ', $allowedTypes)];
    }

    // Validate file size
    if ($fileSize > $maxSizeBytes) {
        return ['success' => false, 'message' => "File too large. Max size: {$maxSizeMB}MB"];
    }

    // Make sure target directory exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Generate unique file name
    // $newFileName = uniqid() . '.' . $fileExt;

    $targetPath = $targetDir . $fileName;

    // Move the file
    if (move_uploaded_file($fileTmp, $targetPath)) {
        return ['success' => true, 'file_path' => $targetPath, 'file_name' => $fileName];
    } else {
        return ['success' => false, 'message' => 'Failed to move uploaded file.'];
    }
}
