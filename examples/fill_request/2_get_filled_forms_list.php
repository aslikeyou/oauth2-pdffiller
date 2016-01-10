<?php

$provider = require_once __DIR__.'/../bootstrap/initWithFabric.php';

$fillRequestEntity = new \aslikeyou\OAuth2\Client\Provider\FillRequest($provider);

//List all filled forms
$e = $fillRequestEntity->listFilledForms('49458019');
dd($e);

