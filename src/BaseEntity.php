<?php
/**
 * Created by PhpStorm.
 * User: aslikeyou
 * Date: 11/12/15
 * Time: 1:08 PM
 */

namespace aslikeyou\OAuth2\Client\Provider;


class BaseEntity
{
    /**
     * @var Pdffiller
     */
    public $client;

    /**
     * SignatureRequest constructor.
     */
    public function __construct(Pdffiller $client)
    {
        $this->client = $client;
    }
}