<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/src/Pdffiller.php';

// Note: the GenericProvider requires the `urlAuthorize` option, even though
// it's not used in the OAuth 2.0 client credentials grant type.

$provider = new \aslikeyou\OAuth2\Client\Provider\PdffillerProvider([
    'clientId'                => '9ae2dd4788374224',    // The client ID assigned to you by the provider
    'clientSecret'            => 'aR7UlwmJyaxQeJruo1eHyLXzemf3tNB8',    // The client password assigned to you by the provider
    'redirectUri'             => 'http://pdffiller.local/index.php',
    'urlAuthorize'            => 'http://api.pdffiller.local/v1/oauth/authorize',
    'urlAccessToken'          => 'http://api.pdffiller.local/v1/oauth/access_token',
    'urlResourceOwnerDetails' => 'http://api.pdffiller.local/v1/resource'
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
        $accessToken = $provider->getAccessToken('client_credentials');
        $liveTimeInSec = \Carbon\Carbon::createFromTimestamp($accessToken->getExpires(), $tz)->diffInSeconds(\Carbon\Carbon::now($tz));
        $kvs->set('access_token', $accessToken->getToken());
        $kvs->expire('access_token', $liveTimeInSec);
        $accessTokenString = $accessToken->getToken();
    }


    $authRequest = $provider->getAuthenticatedRequest(
        'GET',
        'http://api.pdffiller.local/v1/test',
        $accessTokenString
    );

    dd($provider->getResponse($authRequest));
    // Try to get an access token using the client credentials grant.

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

    // Failed to get the access token
    dd($e);

}