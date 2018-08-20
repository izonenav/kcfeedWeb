<?php
$host = "localhost";
$user = "root";
$password = "root";
$db_name = "nse";

$connect = new mysqli($host, $user, $password, $db_name);
$connect->set_charset('utf8');
?>