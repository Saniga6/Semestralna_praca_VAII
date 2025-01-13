<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\JsonResponse;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;
use App\Helpers\FileStorage;
use App\Models\Rating;
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

    public function filter(): JsonResponse
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Načítanie dát z požiadavky
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['ajax']) && $input['ajax'] === 'filter_recipes') {
                $categories = $input['categories'];
                $allRecipes = Recept::getAll();
                $filteredRecipes = [];

                // Filtrovanie receptov podľa kategórií
                foreach ($allRecipes as $recipe) {
                    $recipeCategories = explode(',', $recipe->getCategories());
                    if (!empty($categories) && array_intersect($categories, $recipeCategories)) {
                        $recipeData = [
                            'id' => $recipe->getId(),
                            'name' => $recipe->getName(),
                            'ingredients' => $recipe->getIngredients(),
                            'image' => FileStorage::UPLOAD_DIR . '/' . $recipe->getImage(),
                            'url' => $this->url('home.recept', ['id' => $recipe->getId()]),
                            'rating' => number_format($this->calculateAverageRating($recipe->getId()), 2)
                        ];

                        $filteredRecipes[] = $recipeData;
                    } elseif (empty($categories)) {
                        $recipeData = [
                            'id' => $recipe->getId(),
                            'name' => $recipe->getName(),
                            'ingredients' => $recipe->getIngredients(),
                            'image' => FileStorage::UPLOAD_DIR . '/' . $recipe->getImage(),
                            'url' => $this->url('home.recept', ['id' => $recipe->getId()]),
                            'rating' => number_format($this->calculateAverageRating($recipe->getId()), 2)
                        ];
                        $filteredRecipes[] = $recipeData;
                    }
                }
                return new JsonResponse($filteredRecipes);
            }
        }
        return new JsonResponse([]);
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

    private function calculateAverageRating($recipeId): float|int
    {
        $ratings = Rating::getAll($recipeId);
        $totalRating = 0;
        $ratingCount = 0;
        if (count($ratings) === 0) {
            return 0;
        }
        foreach ($ratings as $rating) {
            if ($recipeId == $rating->getReceptId()) {
                $totalRating += $rating->getRating();
                $ratingCount++;
            }
        }
        return $totalRating / $ratingCount;

    }
}
