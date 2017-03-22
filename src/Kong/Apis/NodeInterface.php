<?php

namespace TheRealGambo\Kong\Apis;

interface NodeInterface
{
    public function getInformation(array $headers = []);
    public function getStatus(array $headers = []);
}
