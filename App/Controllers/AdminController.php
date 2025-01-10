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
        $admin = $this->request()->getValue('admin');
        if ($admin == $user->getIsAdmin()) {
            return $this->redirect($this->url('admin.index'));
        }
        if ($admin == 'on') {
            $admin = 1;
        } else {
            $admin = 0;
        }
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
