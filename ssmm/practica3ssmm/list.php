<?php

require_once 'ssmm_db.php';
$username = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
}

$db = new ssmm_db();
echo $db->showUsers($username);
?>
