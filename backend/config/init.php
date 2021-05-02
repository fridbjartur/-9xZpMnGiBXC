<?php
require_once(__DIR__ . '/database.php');
require_once(__DIR__ . '/../classes/class-question.php');
require_once(__DIR__ . '/../classes/class-user.php');

$database = new Database();
$db = $database->getConnection();

$items = new Question($db);
$users = new User($db);
