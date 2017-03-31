<?php

namespace TheRealGambo\Kong\Apis;

final class Upstream extends AbstractApi implements UpstreamInterface
{
    /**
     * Array of valid body options
     *
     * @var array
     */
    private $upstreamAllowedOptions = ['name', 'slots', 'orderlist'];

    /**
     * Array of valid body options
     *
     * @var array
     */
    private $targetAllowedOptions   = ['target', 'weight'];

    /**
     * Add an upstream entry to Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#add-upstream
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function add(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->upstreamAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('upstreams', $body, $headers);
    }

    /**
     * Add a target to an upstream on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#add-target
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function addTarget($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->targetAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('upstreams/' . $identifier . '/targets', $body, $headers);
    }

    /**
     * Delete an upstream from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#delete-upstream
     *
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, array $headers = [])
    {
        return $this->deleteRequest('upstreams/' . $identifier, $headers);
    }

    /**
     * Disable an upstream target in the load-balancer
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#delete-target
     *
     * @param $identifier
     * @param $target_identifier
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function disableTarget($identifier, $target_identifier, array $headers = [])
    {
        return $this->deleteRequest('upstreams/' . $identifier . '/targets/' . $target_identifier, $headers);
    }

    /**
     * Retrieve a specific upstream from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#retrieve-upstream
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function get($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('upstreams/' . $identifier, $params, $headers);
    }

    /**
     * Retrieve all upstreams from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#list-upstreams
     *
     * @param array $params
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function list(array $params = [], array $headers = [])
    {
        return $this->getRequest('upstreams', $params, $headers);
    }

    /**
     * Retrieve all targets for an upstream from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#list-targets
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function listTargets($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('upstreams/' . $identifier . '/targets', $params, $headers);
    }

    /**
     * Retrieve all active targets for an upstream in Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#list-active-targets
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function listActiveTargets($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('upstreams/' . $identifier . '/targets/active', $params, $headers);
    }

    /**
     * Update an upstream entry on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#update-upstream
     *
     * @param $identifier
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function update($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->upstreamAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->patchRequest('upstreams/' . $identifier, $body, $headers);
    }

    /**
     * Update or Create a new upstream on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#update-or-create-upstream
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function updateOrCreate(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(array_merge($this->upstreamAllowedOptions, ['id']));
        $body = $this->createRequestBody($body);

        return $this->putRequest('upstreams', $body, $headers);
    }
}
