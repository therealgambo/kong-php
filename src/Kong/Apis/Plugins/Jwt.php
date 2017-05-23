<?php

namespace TheRealGambo\Kong\Apis\Plugins;

use TheRealGambo\Kong\Apis\AbstractApi;
use TheRealGambo\Kong\Apis\Consumer;

final class Jwt extends AbstractApi implements JwtInterface
{
    /**
     * Create a new consumer in Kong
     *
     * @see https://getkong.org/plugins/jwt/#create-a-consumer
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function createConsumer(array $body = [], array $headers = [])
    {
        $consumer = new Consumer($this->url, $this->port);

        return $consumer->add($body, $headers);
    }

    /**
     * Create a new JWT credential for a consumer
     *
     * @see https://getkong.org/plugins/jwt/#create-a-jwt-credential
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function create($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(['key', 'algorithm', 'rsa_public_key', 'secret']);
        $body = $this->createRequestBody($body);

        return $this->postRequest('consumers/' . $identifier . '/jwt', $body, $headers);
    }

    /**
     * Delete a JWT credential for a consumer
     *
     * @see https://getkong.org/plugins/jwt/#delete-a-jwt-credential
     *
     * @param string $identifier
     * @param string $jwt_identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, $jwt_identifier, array $headers = [])
    {
        return $this->deleteRequest('consumers/' . $identifier . '/jwt/' . $jwt_identifier, $headers);
    }

    /**
     * List all JWT credentials for a consumer
     *
     * @see https://github.com/Mashape/getkong.org/issues/423
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function list($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('consumers/' . $identifier . '/jwt', $params, $headers);
    }
}
