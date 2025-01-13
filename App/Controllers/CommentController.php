<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\Response;
use App\Models\Comment;
use App\Models\Recept;
use Exception;

class CommentController extends AControllerBase
{
    /**
     * @throws Exception
     */
    public function authorize($action): bool
    {
        switch ($action) {
            case 'add':
            case 'save':
                return $this->app->getAuth()->isLogged();
            case 'delete':
            case 'edit':
                $comment = Comment::getOne($this->request()->getValue('id'));
                return ($this->app->getAuth()->getLoggedUserId() == $comment->getUserName()) || $_SESSION['admin'] == 1;
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
            'comments' => Comment::getAll()
        ]);
    }

    public function add() : Response
    {
        return $this->html([]);
    }

    /**
     * @throws Exception
     */
    public function edit() : Response
    {
        $id = $this->request()->getValue('id');
        $comment = Comment::getOne($id);
        $comentar = $this->request()->getValue('comment');
        $comment->setComment($this->request()->getValue('comment'));
        $comment->save();
        return $this->redirect($this->url('home.recept', ['id' => $comment->getReceptId()]));
    }

    /**
     * @throws Exception
     */
    public function save() : Response
    {
        $comment = new Comment();
        $id = (int)$this->request()->getValue('id');
        $comment->setId($id);
        $comment->setUserName($this->app->getAuth()->getLoggedUserId());
        $comment->setReceptId((int)$this->request()->getValue('recept_id'));
        $comment->setComment($this->request()->getValue('comment-text'));
        $comment->save();
        return $this->redirect($this->url('home.recept', ['id' => $comment->getReceptId()]));
    }

    /**
     * @throws Exception
     */
    public function delete() : Response
    {
        $id = $this->request()->getValue('id');
        $comment = Comment::getOne($id);
        $comment->delete();
        return $this->redirect($this->url('home.recept', ['id' => $comment->getReceptId()]));
    }
}