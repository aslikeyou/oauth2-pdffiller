<?php

$provider = require_once __DIR__.'/../bootstrap/initWithFabric.php';
$signatureRequestFormEntity = new \aslikeyou\OAuth2\Client\Provider\SignatureRequest($provider);

$e = $signatureRequestFormEntity->signedDocument('4240');
dd($e);
