<?php

namespace TheRealGambo\Kong\Apis;

final class Plugin extends AbstractApi implements PluginInterface
{
    /**
     * Array of valid body options
     *
     * @var array
     */
    private $pluginAllowedOptions = ['name', 'consumer_id'];

    /**
     * Add a plugin to an API on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#add-plugin
     *
     * @param string $api_identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function add($api_identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->pluginAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('apis/' . $api_identifier . '/plugins', $body, $headers);
    }

    /**
     * Add a plugin globally to every API on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#add-plugin
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function addGlobalPlugin(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->pluginAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('plugins', $body, $headers);
    }

    /**
     * Remove a plugin from an API
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#delete-plugin
     *
     * @param string $api_identifier
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($api_identifier, $identifier, array $headers = [])
    {
        return $this->deleteRequest('apis/' . $api_identifier . '/plugins/' . $identifier, $headers);
    }

    /**
     * Retrieve information about a specific plugin from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#retrieve-plugin
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function get($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('plugins/' . $identifier, $params, $headers);
    }

    /**
     * Retrieve all available plugins from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#retrieve-enabled-plugins
     *
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function getAllAvailable(array $headers = [])
    {
        return $this->getRequest('/plugins/enabled', [], $headers);
    }

    /**
     * Retrieve the schema for a specific plugin from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#retrieve-plugin-schema
     *
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function getPluginSchema($identifier, array $headers = [])
    {
        return $this->getRequest('plugins/schema/' . $identifier, [], $headers);
    }

    /**
     * Retrieve all plugins configured from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#list-all-plugins
     *
     * @param array $params
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function list(array $params = [], array $headers = [])
    {
        return $this->getRequest('plugins', $params, $headers);
    }

    /**
     * Retrieve all plugins configured for a specific API from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#list-plugins-per-api
     *
     * @param string $api_identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function listAllPerApi($api_identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('apis/' . $api_identifier . '/plugins', $params, $headers);
    }

    /**
     * Update a plugins configuration on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#update-plugin
     *
     * @param string $api_identifier
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function update($api_identifier, $identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->pluginAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->patchRequest('apis/' . $api_identifier . '/plugins/' . $identifier, $body, $headers);
    }

    /**
     * Update or create a plugin on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#update-or-add-plugin
     *
     * @param string $api_identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function updateOrAdd($api_identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(array_merge($this->pluginAllowedOptions, ['id']));
        $body = $this->createRequestBody($body);

        return $this->putRequest('apis/' . $api_identifier . '/plugins', $body, $headers);
    }
}
