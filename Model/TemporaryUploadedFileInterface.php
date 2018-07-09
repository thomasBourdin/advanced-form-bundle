<?php

namespace Sherlockode\AdvancedFormBundle\Model;

interface TemporaryUploadedFileInterface
{
    /**
     * @return string
     */
    public function getKey();

    /**
     * @param string $key
     */
    public function setKey($key);

    /**
     * @return string
     */
    public function getToken();

    /**
     * @param string $token
     */
    public function setToken($token);
}