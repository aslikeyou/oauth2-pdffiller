<?php

$provider = require_once __DIR__.'/../bootstrap/initWithFabric.php';
$document_id = '49458019';

$fillRequestEntity = new \aslikeyou\OAuth2\Client\Provider\FillRequest($provider);
$fillRequestDto = new \aslikeyou\OAuth2\Client\Provider\Dto\FillRequestDto($document_id);

$fillRequestDto->setAccess('signature');
$fillRequestDto->setEmailRequired(true);
$fillRequestDto->addNotificationEmails('someemail@pdffiller.com','John');

$fillRequest = $fillRequestDto->toArray();

//Create fill form request
$e = $fillRequestEntity->createFillRequest($fillRequest);
dd($e);

