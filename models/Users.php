<?php

namespace models;

use core\Core;

class Users {
    public static $tabelName = "Users";

    public static function getUsers() {
        return Core::getInstance()->context->table(self::$tabelName)->select()->execute();
    }
    public static function getUser($login) {
        return Core::getInstance()->context->table(self::$tabelName)->select()->where(["login" => $login])->execute()[0] ?? null;
    }
    public static function loginUser($user) {
        $_SESSION["user"] = $user;
    }
    public static function registerUser($login, $password, $age){
        $result = Core::getInstance()->context->table(self::$tabelName)->insert([
            "login" => $login,
            "password" => $password,
            "age" => $age
        ])->execute();
        return $result;
    }
    public static function getLoginedUser(){
        return $_SESSION["user"] ?? null;
    }
    public static function logoutUser(){
        unset($_SESSION["user"]);
    }
    public static function currentUserIsAdmin(){
        $user = self::getLoginedUser();
        if (empty($user)) {
            return false;
        }
        return boolval($user["is_admin"]);
    }
}