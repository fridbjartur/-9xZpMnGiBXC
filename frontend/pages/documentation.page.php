<?php
$sPathUrl = $_SERVER['HTTP_HOST'] . '/api/v1';
?>
<h1>API documentation</h1>
<h2>Lookups</h2>
<p>These API's returns a list of the id's and titles of the filter conditions, which is good for development purposes.</p>
<div class="alert alert-secondary" role="alert">
    <?= $sPathUrl . '/categories' ?>
</div>
<div class="alert alert-secondary" role="alert">
    <?= $sPathUrl . '/types' ?>
</div>
<div class="alert alert-secondary" role="alert">
    <?= $sPathUrl . '/difficulties' ?>
</div>

<h2>Questions</h2>
<p>It is possible to filter the questions with GET variables. These variables can be combined.</p>

<ul>
    <li>/api/v1?amount= <mark>(int) amount to return</mark></li>
    <li>/api/v1?category= <mark>(int) ID of the category to return</mark></li>
    <li>/api/v1?type= <mark>(int) ID of the type to return</mark></li>
    <li>/api/v1?difficulty= <mark>(int) ID of the difficulty to return</mark></li>
    <li>/api/v1?random <mark>Returns random questions</mark></li>
</ul>