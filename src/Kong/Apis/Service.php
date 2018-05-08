<?php

namespace TheRealGambo\Kong\Apis;

final class Service extends AbstractApi implements ServiceInterface
{
    /**
     * Array of valid body options
     *
     * @var array
     */
    private $serviceAllowedOptions = [
        'name', 'protocol', 'host', 'port', 'path', 'retries', 'connect_timeout',
        'write_timeout', 'read_timeout', 'url'
    ];

    /**
     * Add a Service to Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#add-service
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function add(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->serviceAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('services', $body, $headers);
    }

    /**
     * Delete a Service from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#delete-service
     *
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, array $headers = [])
    {
        return $this->deleteRequest('services/' . $identifier, $headers);
    }

    /**
     * Retrieve information about a specific Service from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#retrieve-service
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function get($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('services/' . $identifier, $params, $headers);
    }

    /**
     * Retrieve information about a specific Service from Kong using the route ID
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#retrieve-service
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function getServiceByRouteId($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('routes/' . $identifier . '/service', $params, $headers);
    }

    /**
     * List all Services in Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#list-services
     *
     * @param array $params
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function list(array $params = [], array $headers = [])
    {
        return $this->getRequest('services', $params, $headers);
    }

    /**
     * Update a Service on Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#update-service
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function update($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->serviceAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->patchRequest('services/' . $identifier, $body, $headers);
    }

    /**
     * Update a Service on Kong using the route ID
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#update-service
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function updateServiceByRouteId($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->serviceAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->patchRequest('routes/' . $identifier . '/service', $body, $headers);
    }
}
