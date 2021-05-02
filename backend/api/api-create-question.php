<?php
session_start();

require_once(__DIR__ . '/../config/init.php');

$items->createQuestion($_POST);
