<?php
$aKeywords = array("categories", "types", "difficulties");
if (!in_array($type, $aKeywords)) {
    http_response_code(404);
    header('Location: /404');
    exit;
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once(__DIR__ . '/../config/init.php');

if (!empty($items->getFilters($type))) {
    echo json_encode($items->getFilters($type));
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
