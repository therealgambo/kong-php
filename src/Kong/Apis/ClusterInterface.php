<?php

namespace TheRealGambo\Kong\Apis;

interface ClusterInterface
{
    public function getInformation(array $headers = []);
    public function getStatus(array $headers = []);
    public function deleteClusterNode($identifier, array $headers = []);
}
