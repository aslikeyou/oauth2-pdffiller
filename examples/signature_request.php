<?php

/** @var \aslikeyou\OAuth2\Client\Provider\Pdffiller $provider */
$provider = require __DIR__.'/_init.php';
require __DIR__.'/../src/SignatureRequest.php';

$sr = new \aslikeyou\OAuth2\Client\Provider\SignatureRequest($provider);

dd($sr->listItems());