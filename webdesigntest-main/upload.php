<?php
// upload.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["videoFile"]["name"]);

    // Check if the file is a valid video
    $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $validFormats = ['mp4', 'avi', 'mov', 'wmv'];

    if (in_array($videoFileType, $validFormats)) {
        if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $targetFile)) {
            // Return success message with link to start compression
            echo "The file " . htmlspecialchars(basename($_FILES["videoFile"]["name"])) . " has been uploaded.";
            echo "<br><button onclick='startCompression(\"" . urlencode($targetFile) . "\")'>Start Compression</button>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Invalid file format. Only MP4, AVI, MOV, and WMV are allowed.";
    }
}
?>
