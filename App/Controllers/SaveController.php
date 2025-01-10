<?php

namespace App\Controllers;

class SaveController extends AControllerBase
{
    public function authorize($action): bool
    {
        return $this->app->getAuth()->isLogged();
    }

    public function index()
    {
        return $this->html([]);
    }

    public function save()
    {
        $recept = $this->request()->getValue('recept');
        $user = $this->app->getAuth()->getLoggedUserId();

        $save = new Save();
        $save->setRecept($recept);
        $save->setUserId($user);
        $save->save();

        return $this->redirect($this->url('home.index'));
    }

    public function delete()
    {
        $id = $this->request()->getValue('id');
        $save = Save::getOne($id);
        $save->delete();

        return $this->redirect($this->url('home.index'));
    }
}