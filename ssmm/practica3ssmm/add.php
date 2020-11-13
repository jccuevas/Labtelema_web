<?php

//Parámetros de entrada user y pass
require_once 'ssmm_db.php';


$username = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_GET, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
}

if ($username != "" && $password != "") {

    $db = new ssmm_db();
    echo $db->addUser($username, $password);
} else
    echo 'ERROR';
?>
