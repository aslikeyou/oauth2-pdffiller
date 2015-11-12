<?php

namespace aslikeyou\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\GenericProvider;
use InvalidArgumentException;
use League\Uri\Schemes\Http as HttpUri;
use League\Uri\Modifiers\Resolve;

/**
 * Represents a generic service provider that may be used to interact with any
 * OAuth 2.0 service provider, using Bearer token authentication.
 */
class Pdffiller extends GenericProvider
{
    private $urlApiDomain;
    private $accessTokenHash;

    public function __construct(array $options = [], array $collaborators = [])
    {
        $this->assertPdffillerOptions($options);

        $possible   = $this->getPdffillerOptions();
        $configured = array_intersect_key($options, array_flip($possible));

        foreach ($configured as $key => $value) {
            $this->$key = $value;
        }
        // Remove all options that are only used locally
        $options = array_diff_key($options, $configured);

        $options = array_merge([
            'redirectUri'             => 'http://localhost/redirect_uri',
            'urlAuthorize'            => 'http://localhost/url_authorize',
            'urlResourceOwnerDetails' => 'http://localhost/url_resource_owner_details'], $options);
        parent::__construct($options, $collaborators);
    }

    public function getAuthenticatedRequest($method, $url, $token, array $options = [])
    {
        $baseUri     = HttpUri::createFromString($this->urlApiDomain);
        $relativeUri = HttpUri::createFromString($url);
        $modifier    = new Resolve($baseUri);
        $newUri = $modifier->__invoke($relativeUri);
        return parent::getAuthenticatedRequest($method, $newUri, $token, $options);
    }

    public function apiCall($method, $url, $options = []) {
        if($this->accessTokenHash === null) {
            throw new InvalidArgumentException(
                'You did not set access token'
            );
        }

        return $this->getResponse($this->getAuthenticatedRequest($method, $url, $this->getAccessToken(), $options));
    }

    public function queryApiCall($url , $options = []) {
        return $this->apiCall('GET', $url, $options);
    }

    public function postApiCall($url , $options = []) {
        return $this->apiCall('POST', $url, $options);
    }

    public function putApiCall($url , $options = []) {
        return $this->apiCall('PUT', $url, $options);
    }

    public function deleteApiCall($url , $options = []) {
        return $this->apiCall('DELETE', $url, $options);
    }

    /**
     * @return array
     */
    protected function getPdffillerOptions()
    {
        return [
            'urlApiDomain',
        ];
    }

    /**
     * Verifies that all required options have been passed.
     *
     * @param  array $options
     * @return void
     * @throws InvalidArgumentException
     */
    private function assertPdffillerOptions(array $options)
    {
        $missing = array_diff_key(array_flip($this->getPdffillerOptions()), $options);

        if (!empty($missing)) {
            throw new InvalidArgumentException(
                'Required options not defined: ' . implode(', ', array_keys($missing))
            );
        }
    }

    public function getAccessToken($grant = 'client_credentials', array $options = [])
    {
        if($this->accessTokenHash !== null) {
            return $this->accessTokenHash;
        }
        return parent::getAccessToken($grant, $options);
    }

    public function setAccessTokenHash($value) {
        $this->accessTokenHash = $value;
    }


}
