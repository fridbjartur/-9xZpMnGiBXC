<?php
session_start();
require_once("{$_SERVER['DOCUMENT_ROOT']}/start.php");

require_once BACKEND_INIT;
require_once FRONTEND_INCLUDE . 'header.inc.php';
require_once FRONTEND_INCLUDE . 'navbar.inc.php';
require_once FRONTEND_PAGE . 'home.page.php';
require_once FRONTEND_INCLUDE . 'footer.inc.php';
