<?php
/**
 * Created by PhpStorm.
 * User: aslikeyou
 * Date: 11/12/15
 * Time: 11:19 AM
 */

namespace aslikeyou\OAuth2\Client\Provider;


class SignatureRequest extends BaseEntity
{
    public function listItems() {
        return $this->client->queryApiCall('signature_request/');
    }

    public function info($id) {
        return $this->client->queryApiCall('signature_request/'.$id);
    }

    public function certificate($id) {
        return $this->client->queryApiCall('signature_request/'.$id.'/certificate');
    }

    public function signedDocument($id) {
        return $this->client->queryApiCall('signature_request/'.$id.'/signed_document');
    }
}