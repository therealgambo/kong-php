<?php

namespace TheRealGambo\Kong\Apis;

final class Sni extends AbstractApi implements SniInterface
{
    /**
     * Array of valid body options
     *
     * @var array
     */
    private $sniAllowedOptions = ['name', 'ssl_certificate_id'];

    /**
     * Add an SNI entry on Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#add-sni
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function add(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->sniAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('snis', $body, $headers);
    }

    /**
     * Delete an SNI object from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#delete-sni
     *
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, array $headers = [])
    {
        return $this->deleteRequest('snis/' . $identifier, $headers);
    }

    /**
     * Retrieve a specific SNI object from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#retrieve-sni
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function get($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('snis/' . $identifier, $params, $headers);
    }

    /**
     * Retrieve all SNI objects from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#list-snis
     *
     * @param array $params
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function list(array $params = [], array $headers = [])
    {
        return $this->getRequest('snis', $params, $headers);
    }

    /**
     * Update an SNI entry on Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#update-sni
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function update($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->sniAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->patchRequest('snis/' . $identifier, $body, $headers);
    }

    /**
     * Update or Create an SNI entry on Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#update-or-create-sni
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function updateOrCreate(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(array_merge($this->sniAllowedOptions, ['id']));
        $body = $this->createRequestBody($body);

        return $this->putRequest('snis', $body, $headers);
    }
}