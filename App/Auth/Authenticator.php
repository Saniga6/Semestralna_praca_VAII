<?php

namespace App\Auth;
use App\Models\User;

class Authenticator extends DummyAuthenticator
{
    public function login($login, $password): bool
    {
        // Get all users
        $users = User::getAll();
        foreach ($users as $user) {
            // Check if the user exists
            if ($login == $user->getName()) {
                $hashedPassword = $user->getPassword();
                // Check if the password is correct
                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['user'] = $login;
                    $_SESSION['admin'] = $user->getIsAdmin();
                    // Rehash password if needed
                    if (password_needs_rehash($hashedPassword, PASSWORD_DEFAULT)) {
                        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                        $user->save();
                    }
                    return true;
                }
            }
        }
        return false;
    }
}