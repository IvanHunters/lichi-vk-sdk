<?php

namespace Lichi\Vk;

interface ApiProvider
{
    /**
     * ApiProvider constructor.
     * @param string $token
     */
    public function __construct(string $token);

    /**
     * @param string $newToken
     */
    public function changeToken(string $newToken): void;

    /**
     * @param string $method
     * @param array $params
     * @return array
     */
    public function callMethod(string $method, array $params) :array;
}