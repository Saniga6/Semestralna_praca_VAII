<?php

namespace App\Auth;
use App\Models\User;

class Authenticator extends DummyAuthenticator
{
    public function login($login, $password): bool
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($login == $user->getName() && $password == $user->getPassword()) {
                $_SESSION['user'] = $login;
                return true;
            }
        }

        return false;
    }

}