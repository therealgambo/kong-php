<?php

namespace TheRealGambo\Kong\Apis;

final class Consumer extends AbstractApi implements ConsumerInterface
{
    /**
     * Array of valid body options
     *
     * @var array
     */
    private $consumerAllowedOptions = ['username', 'custom_id'];

    /**
     * Create a new consumer in Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#create-consumer
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function add(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->consumerAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('consumers', $body, $headers);
    }

    /**
     * Delete a consumer from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#delete-consumer
     *
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, array $headers = [])
    {
        return $this->deleteRequest('consumers/' . $identifier, $headers);
    }

    /**
     * Retrieve information about a consumer from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#retrieve-consumer
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function get($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('consumers/' . $identifier, $params, $headers);
    }

    /**
     * Retrieve information about a specific plugin assigned to a Kong consumer
     *
     * @see https://github.com/Mashape/kong/pull/2714
     *
     * @param string $identifier
     * @param string $plugin_identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function getConsumerPlugin($identifier, $plugin_identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('consumers/' . $identifier . '/plugins/' . $plugin_identifier, $params, $headers);
    }

    /**
     * Retrieve all consumers from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#list-consumers
     *
     * @param array $params
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function list(array $params = [], array $headers = [])
    {
        return $this->getRequest('consumers', $params, $headers);
    }

    /**
     * Retrieve all plugins that are assigned to a Kong consumer
     *
     * @see https://github.com/Mashape/kong/pull/2714
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function listConsumerPlugins($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('consumers/' . $identifier . '/plugins', $params, $headers);
    }

    /**
     * Update a consumer in Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#update-consumer
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function update($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->consumerAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->patchRequest('consumers/' . $identifier, $body, $headers);
    }

    /**
     * Update or Create a consumer in Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#update-or-create-consumer
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function updateOrCreate(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(array_merge($this->consumerAllowedOptions, ['id']));
        $body = $this->createRequestBody($body);

        return $this->putRequest('consumers', $body, $headers);
    }
}
