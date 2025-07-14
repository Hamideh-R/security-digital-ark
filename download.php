<?php
// Enable error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Paths
$dataFile = __DIR__ . '/data/metadata.json';
$uploadDir = __DIR__ . '/uploads/';

// Check POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['filename'])) {
    die("Invalid request.");
}

$requestedFile = $_POST['filename'];
$passwordInput = $_POST['password'] ?? '';

if (!file_exists($dataFile)) {
    die("No metadata found.");
}

$metadata = json_decode(file_get_contents($dataFile), true);
$fileMeta = null;

// Find the file in metadata
foreach ($metadata as $entry) {
    if ($entry['filename'] === $requestedFile) {
        $fileMeta = $entry;
        break;
    }
}

if (!$fileMeta) {
    die("File not found.");
}

// require_once 'check_group_pass.php';
$hasIndividual = !empty($fileMeta['password']);
$hasGroup = !empty($fileMeta['group']);

if ($hasIndividual) {
    if (empty($passwordInput) || !password_verify($passwordInput, $fileMeta['password'])) {
        die("Incorrect individual password.");
    }
} elseif ($hasGroup) {
    if (empty($passwordInput) || !verifyGroupPassword($fileMeta['group'], $passwordInput)) {
        die("Incorrect group password.");
    }
}

// Serve the file for download
$filePath = $uploadDir . $fileMeta['filename'];

if (!file_exists($filePath)) {
    die("File is missing on the server.");
}

// Send file with headers
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;
