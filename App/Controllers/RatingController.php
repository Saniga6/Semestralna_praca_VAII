<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\LinkGenerator;
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
        $ratingValue = $this->request()->getValue('rating');
        $receptId = $this->request()->getValue('recept_id');
        $ratings = Rating::getAll();
        foreach ($ratings as $rat) {
            if ($rat->getUserName() == $_SESSION['user'] && $rat->getReceptId() == $receptId) {
                echo "Už ste hodnotili tento recept!";
                return $this->redirect($this->url('home.recept', ['id' => $receptId]));
            }
        }
        if ($ratingValue < 1 || $ratingValue > 5) {
            return $this->redirect($this->url('home.recept', ['id' => $receptId]));
        }
        $rating->setRating($ratingValue);
        $rating->setReceptId($receptId);
        $rating->setUserName($_SESSION['user']);
        $rating->save();
        return $this->redirect($this->url('home.recept', ['id' => $receptId]));
    }
}