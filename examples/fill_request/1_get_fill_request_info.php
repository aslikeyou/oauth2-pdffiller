<?php

$provider = require_once __DIR__.'/../bootstrap/initWithFabric.php';

$fillRequestEntity = new \aslikeyou\OAuth2\Client\Provider\FillRequest($provider);

$e = $fillRequestEntity->info('49458019');
dd($e);

