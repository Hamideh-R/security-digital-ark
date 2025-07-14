<?php
$groupFile = __DIR__ . '/data/group-passwords.json';

if (!file_exists($groupFile)) {
    file_put_contents($groupFile, json_encode([]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $group = trim($_POST['group'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($group) || empty($password)) {
        die("Group and password required.");
    }

    $groups = json_decode(file_get_contents($groupFile), true);

    // Save only if not already set
    if (!isset($groups[$group])) {
        $groups[$group] = password_hash($password, PASSWORD_DEFAULT);
        file_put_contents($groupFile, json_encode($groups, JSON_PRETTY_PRINT));
        echo "Group password saved.";
    } else {
        echo "Group already exists.";
    }
} else {
    echo "Invalid request.";
}
