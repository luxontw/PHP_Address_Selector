<?php

class User extends Model
{
    public static function setAddress($user, string $address)
    {
        $sql = 'UPDATE `user` SET `address` = :address WHERE `user`.`id` = :user';
        $query = (new static)->db->prepare($sql);
        $query->bindValue(':user', $user, PDO::PARAM_STR);
        $query->bindValue(':address', $address, PDO::PARAM_STR);
        $query->execute();
        return $query->rowCount();
    }
}