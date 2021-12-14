<?php

class UserController extends Controller implements HasAddress
{   
    private $userId = 2;
    public function setAddress(string $address): bool { return User::setAddress($this->userId, $address); }
}