<?php

namespace controllers;

use core\Controller;
use core\Utils;
use Exception;
use models\Users;

class UsersController extends Controller {
    public function indexAction()
    {
        if (!Users::currentUserIsAdmin()) {
            Utils::throwErrorAccessForbidden();
        }
        return $this->render([
            "users" => Users::getUsers()
        ]);
    }
    public function loginAction()
    {
        if (isset($_POST["submit"])) {
            $login = $_POST["login"];
            $password = $_POST["password"];
            
            $user = Users::getUser($login);

            try {
                if (empty($user)) {
                    throw new Exception("User not found!");
                }
                if ($user["password"] != $password) {
                    throw new Exception("Incorrect password!");
                }
                Users::loginUser($user);
                Utils::Redirect("/");
            } catch (Exception $ex) {
                return $this->render([
                    "login" => $login,
                    "error" => $ex->getMessage()
                ]);
            }
        }
        return $this->render();
    }
    public function signupAction()
    {
        if (isset($_POST["submit"])) {
            $login = $_POST["login"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];
            $age = $_POST["age"];
            
            $user = Users::getUser($login);

            try {
                if (!empty($user)) {
                    throw new Exception("This login already exists!");
                }
                if ($password != $confirmPassword) {
                    throw new Exception("Passwords do not match!");
                }
                if (empty($age)) {
                    throw new Exception("Field Age is empty!");
                }
                if (!is_numeric($age)) {
                    throw new Exception("Age must be numeric!");
                }
                if (intval($age) <= 0) {
                    throw new Exception("Age must be more then 0!");
                }
                Users::registerUser($login, $password, $age);
                Utils::Redirect("/users/login");
            } catch (Exception $ex) {
                return $this->render([
                    "login" => $login,
                    "password" => $password,
                    "error" => $ex->getMessage()
                ]);
            }
        }
        return $this->render();
    }
    public function logoutAction()
    {
        Users::logoutUser();
        Utils::redirect("/users/login");
    }
}