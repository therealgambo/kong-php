<?php

namespace TheRealGambo\Kong\Apis;

use TheRealGambo\Kong\Apis\Plugins\BasicAuthInterface;

final class BasicAuth extends AbstractApi implements BasicAuthInterface
{
    /**
     * Create a new consumer in Kong
     *
     * @see https://getkong.org/plugins/basic-authentication/#create-a-consumer
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
     * Create a new basic auth credential for a consumer
     *
     * @see https://getkong.org/plugins/basic-authentication/#create-a-credential
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function create($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(['username', 'password']);
        $body = $this->createRequestBody($body);

        return $this->postRequest('consumers/' . $identifier . '/basic-auth', $body, $headers);
    }

    /**
     * Delete a basic auth credential for a consumer
     *
     * @see
     *
     * @param $identifier
     * @param $auth_identifier
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, $auth_identifier, array $headers = [])
    {
        return $this->deleteRequest('consumers/' . $identifier . '/basic-auth/' . $auth_identifier, $headers);
    }

    /**
     * List all basic auth credentials for a consumer
     *
     * @see
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function list($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('consumers/' . $identifier . '/basic-auth', $params, $headers);
    }

    /**
     * Get a single basic auth credential for a consumer
     *
     * @see
     *
     * @param string $identifier
     * @param string $auth_identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function get($identifier, $auth_identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('consumers/' . $identifier . '/basic-auth/' . $auth_identifier, $params, $headers);
    }
}
