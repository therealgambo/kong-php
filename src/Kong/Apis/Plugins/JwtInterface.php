<?php

namespace TheRealGambo\Kong\Apis\Plugins;

interface JwtInterface
{
    public function createConsumer(array $body = [], array $headers = []);
    public function create($identifier, array $body = [], array $headers = []);
    public function delete($identifier, $jwt_identifier, array $headers = []);
    public function list($identifier, array $params = [], array $headers = []);
}
