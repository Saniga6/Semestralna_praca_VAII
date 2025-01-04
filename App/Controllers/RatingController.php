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
        return match ($action) {
            'save' => $this->app->getAuth()->isLogged(),
            default => true,
        };
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
        return $this->html();
    }
}