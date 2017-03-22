<?php

namespace TheRealGambo\Kong\Apis;

interface ApiInterface
{
    public function add(array $body = [], array $headers = []);
    public function delete($identifier, array $headers = []);
    public function get($identifier, array $params = [], array $headers = []);
    public function list(array $params = [], array $headers = []);
    public function update($identifier, array $body = [], array $headers = []);
    public function updateOrCreate(array $body = [], array $headers = []);
}
