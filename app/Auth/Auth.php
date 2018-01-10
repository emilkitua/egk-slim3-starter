<?php

namespace App\Auth;

use App\Models\UserPermission;
use App\Models\User;

class Auth
{
    public function user()
    {
        if (isset($_SESSION['username'])) {
            return User::where('u_username', $_SESSION['username'])->first();
        }
        return false;
    }

    public function check()
    {
        return isset($_SESSION['username']);
    }

    public function attempt($email, $password)
    {
        $user = User::where('u_email', $email)
                    ->orWhere('u_username', $email)->first();
                    
        if (!$user) {
            return false;
        } else {
            //check if user is admin
            $user_permission = UserPermission::where('u_id', $user->id)->first();

            if($user_permission->is_admin == false){
                //check if the password is correct
                if (password_verify($password, $user->u_password)) {
                    $_SESSION['user'] = $user->u_id;
                    $_SESSION['username'] = $user->u_username;

                    //fetch user's ip address
                    $ip = $_SERVER['REMOTE_ADDR'];

                    //update users ip_address
                    $update = $user->update(['u_ip_address' => $ip]);                    

                    return true;
                }
            } else {
                return false;
            }            
        }        
    }

    public function logout()
    {
        unset($_SESSION['username']);
    }
}