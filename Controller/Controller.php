<?php

class Controller
{
    public function __construct()
    {
        $model = str_replace('Controller', '', get_class($this));
        $model = 'Model/' . $model . '.php';
        if (file_exists($model)) { require $model; }
    }
}

interface HasAddress
{
    function setAddress(string $address): bool;
}