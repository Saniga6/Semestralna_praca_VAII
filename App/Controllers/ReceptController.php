<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Recept;
use Exception;

class ReceptController extends AControllerBase
{
    /**
     * @throws Exception
     */
    public function authorize($action): bool
    {
        switch ($action) {
            case 'add':
                return $this->app->getAuth()->isLogged();
            case 'delete':
            case 'edit':
                $recept = Recept::getOne($this->request()->getValue('id'));
                return $this->app->getAuth()->getLoggedUserId() == $recept->getUserName();
            default:
                return true;
        }
    }

    /**
     * @throws Exception
     */
    public function index() : Response
    {
        return $this->html([
            'recepts' => Recept::getAll()
        ]);
    }

    public function add() : Response
    {
        return $this->html([]);
    }

    /**
     * @throws HTTPException
     * @throws Exception
     */
    public function edit() : Response
    {
        $id = $this->request()->getValue('id');
        $recept = Recept::getOne($id);

        if ($recept == null) {
            return throw new HTTPException(404);
        }
        return $this->html([
            'recept' => $recept
        ]);
    }

    /**
     * @throws HTTPException
     * @throws Exception
     */
    public function save() : Response
    {
        $id = (int)$this->request()->getValue('id');
        $oldFileName = "";
        if ($id > 0) {
            $recept = Recept::getOne($id);
            $oldFileName = $recept->getImage();
        } else {
            $recept = new Recept();
        }
        $recept->setId($id);
        $isPrevious = $this->request()->getFiles()['image']['name'];
        if ($isPrevious != "") {
            $newFileName = FileStorage::saveFile($this->request()->getFiles()['image']);
            $recept->setImage($newFileName);
        } else {
            $recept->setImage($oldFileName);
        }
        if ($this->request()->getValue('categories') != null) {
            $selectedCategories = $_POST['categories'] ?? [];
            $categories = implode(",", $selectedCategories);
            $recept->setCategories($categories);
        }
        $recept->setUserName($this->app->getAuth()->getLoggedUserId());
        $recept->setName($this->request()->getValue('name'));
        $recept->setIngredients($this->request()->getValue('ingredients'));
        if (!str_starts_with($recept->getIngredients(), '•')) {
            $recept->setIngredients('• ' . $recept->getIngredients());
        }
        $recept->setProcedure($this->request()->getValue('procedure'));
        if (!str_starts_with($recept->getProcedure(), '•')) {
            $recept->setProcedure('• ' . $recept->getProcedure());
        }
        $recept->save();
        return new RedirectResponse($this->url("home.index"));
    }

    /**
     * @throws Exception
     */
    public function delete() : Response
    {
        $id = $this->request()->getValue('id');
        $recept = Recept::getOne($id);
        FileStorage::deleteFile($recept->getImage());
        $recept->delete();
        return $this->redirect($this->url('home.index'));
    }
}