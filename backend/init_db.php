<?php 

require_once('init_pdo.php');

$sql = file_get_contents("sql/database.sql");
$request = $pdo->prepare($sql);
$request->execute();

$pdo = null;
