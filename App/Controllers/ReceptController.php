<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Post;
use App\Models\Recept;

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
        $recept->setName($this->request()->getValue('name'));
        $recept->setIngredients($this->request()->getValue('ingredients'));
        $recept->setProcedure($this->request()->getValue('procedure'));

        /*$formErrors = $this->formErrors();
        if (count($formErrors) > 0) {
            return $this->html(
                [
                    'recept' => $recept,
                    'errors' => $formErrors
                ], 'add'
            );
        } else {
            if ($oldFileName != "") {
                FileStorage::deleteFile($oldFileName);
            }
            $newFileName = FileStorage::saveFile($this->request()->getFiles()['image']);
            $recept->setPicture($newFileName);
            $recept->save();*/
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

    private function formErrors(): array
    {
        /*
        $errors = [];
        if ($this->request()->getFiles()['picture']['name'] == "") {
            $errors[] = "Pole Súbor obrázka musí byť vyplnené!";
        }
        if ($this->request()->getValue('text') == "") {
            $errors[] = "Pole Text príspevku musí byť vyplnené!";
        }
        if ($this->request()->getFiles()['picture']['name'] != "" && !in_array($this->request()->getFiles()['picture']['type'], ['image/jpeg', 'image/png'])) {
            $errors[] = "Obrázok musí byť typu JPG alebo PNG!";
        }
        if ($this->request()->getValue('text') != "" && strlen($this->request()->getValue('text') < 5)) {
            $errors[] = "Počet znakov v text príspevku musí byť viac ako 5!";
        }
        return $errors;
        */
        return [];
    }
}