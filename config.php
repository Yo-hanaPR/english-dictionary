<?php

$host = "localhost";
$dbname = "english_dictionary";
$username = "root";
$password = "";
/*

$host = "sql312.infinityfree.com";
$dbname = "if0_38229237_englishdictionary";
$username = "if0_38229237";
$password = "32D2f71TO2vE4zN";  */
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
