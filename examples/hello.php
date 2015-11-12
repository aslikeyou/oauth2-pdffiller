<?php

/** @var \aslikeyou\OAuth2\Client\Provider\Pdffiller $provider */
$provider = require __DIR__.'/_init.php';

dd($provider->queryApiCall('test'));