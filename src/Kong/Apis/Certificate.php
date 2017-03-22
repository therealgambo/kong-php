<?php

namespace TheRealGambo\Kong\Apis;

final class Certificate extends AbstractApi implements CertificateInterface
{
    /**
     * Array of valid body options
     *
     * @var array
     */
    private $certificateAllowedOptions = ['cert', 'key', 'snis'];

    /**
     * Add a new certificate to Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#add-certificate
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function add(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->certificateAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('certificates', $body, $headers);
    }

    /**
     * Delete a specific certificate from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#delete-certificate
     *
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, array $headers = [])
    {
        return $this->deleteRequest('certificates/' . $identifier, $headers);
    }

    /**
     * Retrieve a specific certificate from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#retrieve-certificate
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function get($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('certificates/' . $identifier, $params, $headers);
    }

    /**
     * Retrieve all certificates from Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#list-certificates
     *
     * @param array $params
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function list(array $params = [], array $headers = [])
    {
        return $this->getRequest('certificates', $params, $headers);
    }

    /**
     * Update a certificate on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#update-certificate
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function update($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->certificateAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->patchRequest('certificates/' . $identifier, $body, $headers);
    }

    /**
     * Update or Create a certificate on Kong
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#update-or-create-certificate
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function updateOrCreate(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(array_merge($this->certificateAllowedOptions, ['id']));
        $body = $this->createRequestBody($body);

        return $this->putRequest('certificates', $body, $headers);
    }
}
