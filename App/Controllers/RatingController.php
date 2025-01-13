<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\JsonResponse;
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
    public function save() : JsonResponse
    {
        $rawInput = file_get_contents('php://input');
        $decodedInput = json_decode($rawInput, true);

        $ratingValue = $decodedInput['rating'] ?? null;
        $receptId = $decodedInput['recept_id'] ?? null;
        $userName = $_SESSION['user'] ?? null;

        if (!$userName) {
            return new JsonResponse(['message' => "Používateľ nie je prihlásený."], 401);
        }

        // Overenie, či užívateľ už hlasoval
        $ratings = Rating::getAll();
        foreach ($ratings as $rat) {
            if ($rat->getUserName() == $userName && $rat->getReceptId() == $receptId) {
                return new JsonResponse([
                    'message' => "Už ste hodnotili tento recept.",
                ], 200);
            }
        }

        if (!is_numeric($ratingValue) || $ratingValue < 1 || $ratingValue > 5) {
            return new JsonResponse([
                'message' => "Hodnotenie musí byť medzi 1 a 5.",
            ], 400);
        }

        $rating = new Rating();
        $rating->setRating($ratingValue);
        $rating->setReceptId($receptId);
        $rating->setUserName($userName);
        $rating->save();

        // Vrátenie odpovede, že hodnotenie je možné
        return new JsonResponse([
            'message' => "Hodnotenie sa odoslalo.",
        ], 200);
    }
}