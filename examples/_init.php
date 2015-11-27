<?php

use aslikeyou\OAuth2\Client\Provider\Pdffiller;
use Flintstone\Flintstone;
use AdammBalogh\KeyValueStore\Adapter\FileAdapter;
use AdammBalogh\KeyValueStore\KeyValueStore;
use Carbon\Carbon;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../src/Pdffiller.php';
require __DIR__.'/../src/BaseEntity.php';

$provider = new Pdffiller([
    'clientId'       => '9ae2dd4788374224',
    'clientSecret'   => 'aR7UlwmJyaxQeJruo1eHyLXzemf3tNB8',
    'urlAccessToken' => 'http://api.pdffiller.local/v1/oauth/access_token',
    'urlApiDomain'   => 'http://api.pdffiller.local/v1/'
]);

$tz = 'Europe/Kiev';

$kvs = new KeyValueStore(new FileAdapter(new Flintstone::load('usersDatabase', ['dir' => '/tmp'])));

$accessTokenKey = 'access_token';

if (!$accessTokenString = $kvs->has($accessTokenKey)) {
    $accessToken = $provider->getAccessToken();

    $liveTimeInSec = Carbon::createFromTimestamp(
        $accessToken->getExpires(),
        $tz
    )->diffInSeconds(Carbon::now($tz));

    $kvs->set($accessTokenKey, $accessToken->getToken());
    $kvs->expire($accessTokenKey, $liveTimeInSec);
    $accessTokenString = $accessToken->getToken();
}

$provider->setAccessTokenHash($accessTokenString);

return $provider;
