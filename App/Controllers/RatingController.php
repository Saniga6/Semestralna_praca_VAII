<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Rating;
use Exception;

class RatingController extends AControllerBase
{

    public function authorize($action): bool
    {
        switch ($action) {
            case 'save':
                return $this->app->getAuth()->isLogged();
            default:
                return true;
        }
    }
    /**
     * @throws Exception
     */
    public function index(): Response
    {
        return $this->html(
            [
                'ratings' => Rating::getAll()
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function save() : Response
    {
        $rating = new Rating();
        $rating->setRating($this->request()->getValue('rating'));
        $rating->setReceptId($this->request()->getValue('recept_id'));
        $rating->save();
        return $this->redirect('home.recept', ['id' => $rating->getReceptId()]);
    }
}