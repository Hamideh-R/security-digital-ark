<?php
// Ensure upload and data folders exist
$uploadDir = __DIR__ . '/uploads/';
$dataFile = __DIR__ . '/data/metadata.json';

if (!is_dir($uploadDir)) mkdir($uploadDir);
if (!file_exists($dataFile)) file_put_contents($dataFile, json_encode([]));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        header("Location: index.php?status=error&message=File upload failed.");
        exit;
    }

    $filename = basename($_FILES['file']['name']);
    $tempPath = $_FILES['file']['tmp_name'];
    $destination = $uploadDir . $filename;

    // Prevent overwriting
    if (file_exists($destination)) {
        header("Location: index.php?status=error&message=File already exists.");
        exit;
    }

    // Validate file size (max 10MB)
    if ($_FILES['file']['size'] > 10 * 1024 * 1024) {
        header("Location: index.php?status=error&message=File too large.");
        exit;
    }

    // Validate allowed file types (only images, pdf, zip, etc.)
$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/zip', 'text/plain'];
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $tempPath);
finfo_close($finfo);

if (!in_array($mimeType, $allowedTypes)) {
    header("Location: index.php?status=error&message=File type not allowed.");
    exit;
}
    // Move file
    if (!move_uploaded_file($tempPath, $destination)) {
        header("Location: index.php?status=error&message=Failed to move file.");
        exit;
    }

    // Process metadata
    $password = $_POST['password'] ?? '';
    $group = $_POST['group'] ?? '';
    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

    $metadata = json_decode(file_get_contents($dataFile), true);
    $metadata[] = [
        'filename' => $filename,
        'path' => 'uploads/' . $filename,
        'date' => date('Y-m-d H:i:s'),
        'group' => $group,
        'password' => $hashedPassword
    ];
    file_put_contents($dataFile, json_encode($metadata, JSON_PRETTY_PRINT));

    header("Location: index.php?status=success&message=File uploaded successfully.");
    exit;
}

header("Location: index.php?status=error&message=Invalid request.");
exit;