<?php
$host = "bezserv.mysql.ukraine.com.ua";
$dbname = "bezserv_baza17";
$username = "bezserv_baza17";
$password = "&d9T5S+zj7";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Помилка підключення до БД: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>