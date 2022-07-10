<?php

namespace App\Controllers;

use App\Services\Router;

class Auth {
    
    public function login($data)
    {
        $email = $data['email'];
        $password = $data['password'];

        $user = \R::findOne('users', 'email = ? ', [$email]);

        if (!$user) {
            Router::redirect('login');
            die('User not found!');
        }

        if(password_verify($password, $user->password)) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['user'] = [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'username' => $user->username,
                'group' => $user->group, 
                'email' => $user->email, 
                'avatar' => $user->avatar
            ];
            Router::redirect('profile');
        } else {
            die('Не верний логин или пароль!');
        }
    }
    public function register($data = null, $files = null)
    {
        $email = $data['email'];
        $username = $data['username'];
        $full_name = $data['full_name'];
        $password = $data['password'];
        $password_confirm = $data['password_confirm']; 

        if ($password != $password_confirm) {
            Router::error('500');
            die();
        }
        
        $avatar = $files['avatar'];
        $fileName = time() . '_' . $avatar['name'];
        $path = 'public/uploads/avatars/' . $fileName;

        if (move_uploaded_file($avatar['tmp_name'], $path)) {
            $user = \R::dispense('users');
            $user->email = $email;
            $user->username = $username;
            $user->full_name = $full_name;
            $user->avatar = '/' . $path;
            /** users group
             * 1 - user
             * 2 - admin
             */
            $user->group = 1;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            \R::store($user);
            Router::redirect('login');
        } else {
            Router::error('500');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        Router::redirect('login');
    }
}  