<?php
$groupFile = __DIR__ . '/data/group-passwords.json';

function verifyGroupPassword($group, $passwordInput) {
    global $groupFile;

    if (!file_exists($groupFile)) return false;

    $groups = json_decode(file_get_contents($groupFile), true);

    if (isset($groups[$group])) {
        return password_verify($passwordInput, $groups[$group]);
    }

    return false;
}
