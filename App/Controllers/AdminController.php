<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\Response;
use App\Models\User;
use Exception;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class AdminController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action) : bool
    {
        return $this->app->getAuth()->isLogged() && $_SESSION['admin'] == 1;
    }

    /**
     * @throws Exception
     */
    public function delete() : Response
    {
        $id = $this->request()->getValue('id');
        $user = User::getOne($id);
        $user->delete();
        return $this->redirect($this->url('admin.index'));
    }

    /**
     * @throws Exception
     */
    public function save() : Response
    {
        $id = $this->request()->getValue('id');
        $user = User::getOne($id);
        $name = $this->request()->getValue('name');
        $admin = $this->request()->getValue('admin');
        if ($name != $user->getName() || $admin != $user->getIsAdmin()) {
            $to = $user->getEmail();
            if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                echo 'Invalid email address.';
            }
            $subject = 'Your account has been updated';
            $message = ($admin == 'on') ? 'You are now an admin' : 'You are no longer an admin';
            $message .= ($name != $user->getName()) ? 'Your name has been changed to '.$name : '';
            $headers = 'From: no-reply@gmail.com' . "\r\n";
            mail($to, $subject, $message, $headers);
        }
        if ($admin == 'on') {
            $admin = 1;
        } else {
            $admin = 0;
        }
        $user->setName($name);
        $user->setIsAdmin($admin);
        $user->save();
        return $this->redirect($this->url('admin.index'));
    }

    /**
     * Example of an action (authorization needed)
     */
    public function index(): Response
    {
        return $this->html();
    }
}
