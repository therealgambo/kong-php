<?php

namespace TheRealGambo\Kong\Apis;

interface PluginInterface
{
    public function add(array $body = [], array $headers = []);
    public function delete($api_identifier, $identifier, array $headers = []);
    public function get($identifier, array $params = [], array $headers = []);
    public function getEnabledPlugins(array $params = [], array $headers = []);
    public function getPluginSchema($identifier, array $params = [], array $headers = []);
    public function list(array $params = [], array $headers = []);
    public function update($api_identifier, $identifier, array $body = [], array $headers = []);
    public function updateOrAdd($api_identifier, array $body = [], array $headers = []);
}
