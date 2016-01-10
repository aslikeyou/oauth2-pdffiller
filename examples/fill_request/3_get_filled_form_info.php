<?php

$provider = require_once __DIR__.'/../bootstrap/initWithFabric.php';

$fillRequestEntity = new \aslikeyou\OAuth2\Client\Provider\FillRequest($provider);

//List filled form info
$e = $fillRequestEntity->filledFormInfo('49458019','14469');
dd($e);

