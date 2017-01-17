<?php

class AdminBase {
    /**
     * Check user admin
     * @return bool
     */
    public static function checkAdmin(){
        # check user auth
        $userId = User::checkLogged();
        # get user data
        $user = User::getUserById($userId);
        # check user adnin
        if($user['role'] == 'admin'){
            return true;
        }

        die('Access denied');
    }
} 