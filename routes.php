<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

// ##################################################
// ##################################################
// ##################################################

// GET
any('/', 'views/index.php');

get('/documentation', 'views/documentation.php');

any('/create', 'views/create.php');

get('/about', 'views/about.php');

any('/login', 'views/login.php');

get('/logout', 'views/logout.php');

get('/api/v1', 'backend/api/api-get-questions.php');

get('/api/v1/$type', 'backend/api/api-get-filters.php');

post('/create-api', 'backend/api/api-create-question.php');

any('/404', 'views/404.php');
