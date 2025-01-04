<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;
use App\Models\Recept;
use Exception;

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
    public function authorize($action) : bool
    {
        return true;
    }

    /**
     * Example of an action (authorization needed)
     * @return Response
     * @throws Exception
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
     * @return ViewResponse
     * @throws Exception
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
