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
    public function authorize($action): bool
    {
        switch ($action) {
            case 'add':
            case 'edit':
            case 'delete':
            default:
                return true;
        }
    }
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
        $recept->setName($this->request()->getValue('name'));
        $recept->setIngredients($this->request()->getValue('ingredients'));
        $recept->setProcedure($this->request()->getValue('procedure'));
        $recept->save();
        return new RedirectResponse($this->url("home.index"));
    }

    public function delete() : Response
    {
        $id = $this->request()->getValue('id');
        $recept = Recept::getOne($id);
        FileStorage::deleteFile($recept->getImage());
        $recept->delete();
        return $this->redirect($this->url('home.index'));
    }
}