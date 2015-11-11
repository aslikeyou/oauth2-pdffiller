<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/src/Pdffiller.php';

$provider = new \aslikeyou\OAuth2\Client\Provider\PdffillerProvider([
    'clientId'                => '9ae2dd4788374224',
    'clientSecret'            => 'aR7UlwmJyaxQeJruo1eHyLXzemf3tNB8',
    'urlAccessToken'          => 'http://api.pdffiller.local/v1/oauth/access_token',
    'urlApiDomain'            => 'http://api.pdffiller.local/v1/'
]);

$tz = 'Europe/Kiev';

$fileClient = Flintstone\Flintstone::load('usersDatabase', ['dir' => '/tmp']);
$adapter = new AdammBalogh\KeyValueStore\Adapter\FileAdapter($fileClient);
$kvs = new AdammBalogh\KeyValueStore\KeyValueStore($adapter);

$accessTokenKey = 'access_token';
try {
    if($kvs->has($accessTokenKey)) {
        $accessTokenString = $kvs->get($accessTokenKey);
    } else {
        $accessToken = $provider->getAccessToken();
        $liveTimeInSec = \Carbon\Carbon::createFromTimestamp($accessToken->getExpires(), $tz)->diffInSeconds(\Carbon\Carbon::now($tz));
        $kvs->set('access_token', $accessToken->getToken());
        $kvs->expire('access_token', $liveTimeInSec);
        $accessTokenString = $accessToken->getToken();
    }

    $provider->setAccessTokenHash($accessTokenString);
    dd($provider->getApiCall('test'));
    // Try to get an access token using the client credentials grant.

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

    // Failed to get the access token
    dd($e);

}