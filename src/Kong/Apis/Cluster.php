<?php

namespace TheRealGambo\Kong\Apis;

final class Cluster extends AbstractApi implements ClusterInterface
{
    /**
     * Retrieve information about the Kong cluster
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#cluster-information
     *
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function getInformation(array $headers = [])
    {
        return $this->getRequest('cluster', [], $headers);
    }

    /**
     * Retrieve the Kong cluster status
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#retrieve-cluster-status
     *
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function getStatus(array $headers = [])
    {
        return $this->getRequest('cluster/nodes', [], $headers);
    }

    /**
     * Forcibly remove a node from the Kong cluster
     *
     * @see https://getkong.org/docs/0.10.x/admin-api/#forcibly-remove-a-node
     *
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function deleteClusterNode($identifier, array $headers = [])
    {
        return $this->deleteRequest('/cluster/nodes/' . $identifier, $headers);
    }
}
