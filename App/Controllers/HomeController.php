<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Post;
use App\Models\Recept;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return true;
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        return $this->html(
            [
                'recepts' => Recept::getAll()
            ]
        );
    }

    /**
     * Example of an action accessible without authorization
     * @return \App\Core\Responses\ViewResponse
     */
    public function recept(): Response
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
}
