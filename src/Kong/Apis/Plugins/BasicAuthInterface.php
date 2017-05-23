<?php

namespace TheRealGambo\Kong\Apis\Plugins;

interface BasicAuthInterface
{
    public function createConsumer(array $body = [], array $headers = []);
    public function create($identifier, array $body = [], array $headers = []);
    public function delete($identifier, $auth_identifier, array $headers = []);
    public function list($identifier, array $params = [], array $headers = []);
    public function get($identifier, $auth_identifier, array $params = [], array $headers = []);
}
