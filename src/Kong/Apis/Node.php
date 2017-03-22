<?php

namespace TheRealGambo\Kong\Apis;

final class Node extends AbstractApi implements NodeInterface
{
    /**
     * Retrieve information about the Kong node
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#retrieve-node-information
     *
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function getInformation(array $headers = [])
    {
        return $this->getRequest('', [], $headers);
    }

    /**
     * Retrieve the status of the Kong node
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#retrieve-node-status
     *
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function getStatus(array $headers = [])
    {
        return $this->getRequest('status', [], $headers);
    }
}
