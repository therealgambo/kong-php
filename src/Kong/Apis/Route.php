<?php

namespace TheRealGambo\Kong\Apis;

final class Route extends AbstractApi implements RouteInterface
{
    /**
     * Array of valid body options
     *
     * @var array
     */
    private $routeAllowedOptions = [
        'protocols', 'methods', 'hosts', 'paths', 'strip_path', 'preserve_host', 'service'
    ];

    /**
     * Add a Route to Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#add-route
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function add(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->routeAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('routes', $body, $headers);
    }

    /**
     * Delete a Route from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#delete-route
     *
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, array $headers = [])
    {
        return $this->deleteRequest('routes/' . $identifier, $headers);
    }

    /**
     * Retrieve information about a specific Route from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#retrieve-route
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function get($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('routes/' . $identifier, $params, $headers);
    }

    /**
     * List all Routes in Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#list-routes
     *
     * @param array $params
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function list(array $params = [], array $headers = [])
    {
        return $this->getRequest('routes', $params, $headers);
    }

    /**
     * List all Routes in Kong that are associated with a service
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#list-routes-associated-to-a-service
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function listRoutesWithServiceId($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('services/' . $identifier . '/routes', $params, $headers);
    }

    /**
     * Update a Route on Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#update-route
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function update($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->routeAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->patchRequest('routes/' . $identifier, $body, $headers);
    }
}