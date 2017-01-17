<?php

class UserController {
    public function actionRegister(){
        # default val
        $name     = false;
        $email    = false;
        $password = false;
        $result   = false;

        if(isset($_POST['submit'])){
            # get data
            $name     = $_POST['name'];
            $email    = $_POST['email'];
            $password = $_POST['password'];

            # errors flag
            $errors = false;

            # validation user data
            if(!User::checkName($name)){
             $errors[] = ' - Wrong name, perhaps too short, enter name more than 2 symbols.';
            }

            if(!User::checkEmail($email)){
             $errors[] = ' - Wrong email, perhaps enter correct email.';
            }

            if(!User::checkPassword($password)){
             $errors[] = ' - Wrong Password perhaps too short, enter password more than 6 symbols.';
            }

            if(User::checkEmailExists($email)){
             $errors[] = ' - Email is isset';
            }

            # if valid user data register
            if($errors == false){
                $result = User::register($name, $email, $password);
            }

        }

        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionLogin(){
        # default val
        $email    = false;
        $password = false;

        if(isset($_POST['submit'])){
            # get data
            $email    = $_POST['email'];
            $password = $_POST['password'];

            # error flag
            $errors = false;

            # validation fields
            if(!User::checkEmail($email)){
                $errors[] = ' - Wrong email';
            }

            if(!User::checkPassword($password)){
                $errors[] = ' - Password havn\'t to be shortly six symbols';
            }

            # check user data
            $userId = User::checkUserData($email, $password);

            if($userId == false){
                $errors[] = ' - Wrong user data';
            }else{
                User::auth($userId);

                header('Location: /account/');
            }
        }
        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    public function actionLogout(){

        unset($_SESSION['user']);

        header('Location: /');
    }


} 