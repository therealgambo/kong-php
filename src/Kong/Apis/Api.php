<?php

namespace TheRealGambo\Kong\Apis;

final class Api extends AbstractApi implements ApiInterface
{
    /**
     * Array of valid body options
     *
     * @var array
     */
    private $apiAllowedOptions = ['name', 'hosts', 'uris', 'methods', 'upstream_url', 'strip_uri', 'preserve_host',
                                  'retries', 'upstream_connect_timeout', 'upstream_send_timeout',
                                  'upstream_read_timeout', 'https_only', 'http_if_terminated'];

    /**
     * Add an API to Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#add-api
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function add(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->apiAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('apis', [], $body);
    }

    /**
     * Delete an API endpoint from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#delete-api
     *
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, array $headers = [])
    {
        return $this->deleteRequest('apis/' . $identifier, $headers);
    }

    /**
     * Retrieve information about a specific API from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#retrieve-api
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function get($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('apis/' . $identifier, $params, $headers);
    }

    /**
     * List all API's in Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#list-apis
     *
     * @param array $params
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function list(array $params = [], array $headers = [])
    {
        return $this->getRequest('apis', $params, $headers);
    }

    /**
     * Update an API on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#update-api
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function update($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->apiAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->patchRequest('apis' . $identifier, $body, $headers);
    }

    /**
     * Update or Create an API on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#update-or-create-api
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function updateOrCreate(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(array_merge($this->apiAllowedOptions, ['id']));
        $body = $this->createRequestBody($body);

        return $this->putRequest('apis', $body, $headers);
    }
}
