<?php

namespace TheRealGambo\Kong\Apis;

interface UpstreamInterface
{
    public function add(array $body = [], array $headers = []);
    public function addTarget($identifier, array $body = [], array $headers = []);
    public function delete($identifier, array $headers = []);
    public function deleteTarget($identifier, $target_identifier, array $headers = []);
    public function get($identifier, array $params = [], array $headers = []);
    public function list(array $params = [], array $headers = []);
    public function listTargets($identifier, array $params = [], array $headers = []);
    public function listAllTargets($identifier, array $params = [], array $headers = []);
    public function update($identifier, array $body = [], array $headers = []);
    public function updateOrCreate(array $body = [], array $headers = []);
    public function setTargetHealthy($identifier, $target_identifier, array $body = [], array $headers = []);
    public function setTargetUnhealthy($identifier, $target_identifier, array $body = [], array $headers = []);
}
