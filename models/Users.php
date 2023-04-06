<?php

namespace models;

use core\Core;
use core\Utils;

class Users {
    public static $tabelName = "Users";

    public static function getUsers() {
        return Core::getInstance()->context->table(self::$tabelName)->select()->execute();
    }
    public static function getUser($email) {
        return Core::getInstance()->context->table(self::$tabelName)->select()->where(["email" => $email])->execute()[0] ?? null;
    }
    public static function loginUser($user) {
        $_SESSION["user"] = $user;
    }
    public static function registerUser($name, $lastname, $email, $birthDate, $password){
        $result = Core::getInstance()->context->table(self::$tabelName)->insert([
            "name" => $name,
            "lastname" => $lastname,
            "email" => $email,
            "birth_date" => $birthDate,
            "password" => Utils::Encrypt($password)
        ])->execute();
        return $result;
    }
    public static function getLoginedUser(){
        return $_SESSION["user"] ?? null;
    }
    public static function logoutUser(){
        unset($_SESSION["user"]);
    }
    public static function editUser($email, $name, $lastname, $birth_date){
        Core::getInstance()->context->table(self::$tabelName)->update([
            "name" => $name,
            "lastname" => $lastname,
            "birth_date" => $birth_date
        ])->where([
            "email" => $email
        ])->execute();
    }
    public static function deleteUser($email){
        Core::getInstance()->context->table(self::$tabelName)->delete()->where([
            "email" => $email
        ])->execute();
    }
}