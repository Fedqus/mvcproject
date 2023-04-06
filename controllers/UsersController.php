<?php

namespace controllers;

use core\Controller;
use core\Utils;
use Exception;
use models\Users;

class UsersController extends Controller {
    public function indexAction()
    {
        return $this->render([
            "users" => Users::getUsers()
        ]);
    }
    public function loginAction()
    {
        if (isset($_POST["submit"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            $user = Users::getUser($email);

            try {
                if (empty($user)) {
                    throw new Exception("User not found!");
                }
                if ($user["password"] != Utils::Encrypt($password)) {
                    throw new Exception("Incorrect password!");
                }
                Users::loginUser($user);
                Utils::Redirect("/");
            } catch (Exception $ex) {
                return $this->render([
                    "email" => $email,
                    "error" => $ex->getMessage()
                ]);
            }
        }
        return $this->render();
    }
    public function signupAction()
    {
        if (isset($_POST["submit"])) {
            $name = $_POST["name"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $birth_date = $_POST["birth_date"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];
            
            $user = Users::getUser($email);

            try {
                if (!empty($user)) {
                    throw new Exception("This user already exists!");
                }
                if (empty($email)) {
                    throw new Exception("Field email is empty!");
                }
                if (empty($name)) {
                    throw new Exception("Field name is empty!");
                }
                if (empty($lastname)) {
                    throw new Exception("Field lastname is empty!");
                }
                if (empty($birth_date)) {
                    throw new Exception("Field birth date is empty!");
                }
                if (empty($password)) {
                    throw new Exception("Field password is empty!");
                }
                if ($password != $confirmPassword) {
                    throw new Exception("Passwords do not match!");
                }
                Users::registerUser($name, $lastname, $email, $birth_date, $password);
                Utils::Redirect("/users/login");
            } catch (Exception $ex) {
                return $this->render([
                    "name" => $name,
                    "lastname" => $lastname,
                    "email" => $email,
                    "birth_date" => $birth_date,
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
    public function editAction($params)
    {
        $email = array_shift($params);
        $user = Users::getUser($email);

        if (isset($_POST["submit"])) {
            Users::editUser($email, $_POST["name"], $_POST["lastname"], $_POST["birth_date"]);
            Utils::redirect("/users");
        }

        return $this->render([
            "user" => $user
        ]);
    }
    public function deleteAction($params)
    {
        $email = array_shift($params);
        Users::deleteUser($email);
        Utils::redirect($_SERVER["HTTP_REFERER"]);
    }
}