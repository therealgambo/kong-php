<?php

namespace TheRealGambo\Kong\Apis\Plugins;

use TheRealGambo\Kong\Apis\AbstractApi;
use TheRealGambo\Kong\Apis\Consumer;

final class KeyAuth extends AbstractApi implements KeyAuthInterface
{
    /**
     * Create a new consumer in Kong
     *
     * @see https://getkong.org/plugins/key-authentication/#create-a-consumer
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
     * Create a key auth credential for a consumer
     *
     * @see https://getkong.org/plugins/key-authentication/#create-an-api-key
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function create($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(['key']);
        $body = $this->createRequestBody($body);

        return $this->postRequest('consumers/' . $identifier . '/key-auth', $body, $headers);
    }

    /**
     * Delete a key auth credential for a consumer
     *
     * @see
     *
     * @param string $identifier
     * @param string $auth_identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, $auth_identifier, array $headers = [])
    {
        return $this->deleteRequest('consumers/' . $identifier . '/key-auth/' . $auth_identifier, $headers);
    }

    /**
     * List all key auth credentials for a consumer
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
        return $this->getRequest('consumers/' . $identifier . '/key-auth', $params, $headers);
    }

    /**
     * Get a single key auth credential for a consumer
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
        return $this->getRequest('consumers/' . $identifier . '/key-auth/' . $auth_identifier, $params, $headers);
    }
}
