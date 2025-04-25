<?php

function deleteDirectory($dirPath)
{
    // Check if the directory exists
    if (!is_dir($dirPath)) {
        echo "<script>console.log('Directory does not exist');</script>";
        return;
    }

    // Get all files and directories in the directory
    $files = array_diff(scandir($dirPath), array('.', '..'));

    // Loop through each file/subdirectory
    foreach ($files as $file) {
        $filePath = $dirPath . DIRECTORY_SEPARATOR . $file;

        // If it's a directory, recursively delete its contents
        if (is_dir($filePath)) {
            deleteDirectory($filePath);  // Recursively delete subdirectories
        } else {
            // If it's a file, delete it
            unlink($filePath);
        }
    }

    // After deleting all files and subdirectories, delete the now-empty directory
    rmdir($dirPath);
    echo "<script>console.log('Directory and its contents deleted successfully');</script>";
}




