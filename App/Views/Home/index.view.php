<?php
/** @var LinkGenerator $link */
/** @var Array $data */
/** @var Recept $recept */
/** @var IAuthenticator $auth */

use App\Core\IAuthenticator;
use App\Core\LinkGenerator;
use App\Helpers\FileStorage;
use App\Models\Rating;
use App\Models\Recept;

?>

<div class="grid-container">
    <div class="filter">
        <div class="filter-container">
            <p class="filter-name">Filtrovanie</p>
            <div class="filter-all-text">
                <label class="filter-text" for="option1"><input class="filter-text" type="checkbox" id="option1" value="Mäsité">Mäsité pokrmy</label>
                <label class="filter-text" for="option2"><input class="filter-text" type="checkbox" id="option2" value="Sladké">Sladké pokrmy</label>
                <label class="filter-text" for="option3"><input class="filter-text" type="checkbox" id="option3" value="Slané">Slané pokrmy</label>
                <label class="filter-text" for="option4"><input class="filter-text" type="checkbox" id="option4" value="Tradičné">Tradičné pokrmy</label>
                <label class="filter-text" for="option5"><input class="filter-text" type="checkbox" id="option5" value="Exotické">Exotické pokrmy</label>
                <label class="filter-text" for="option6"><input class="filter-text" type="checkbox" id="option6" value="Vegetariánske">Vegetariánske pokrmy</label>
                <label class="filter-text" for="option7"><input class="filter-text" type="checkbox" id="option7" value="Vegánske">Vegánske pokrmy</label>
            </div>
        </div>
    </div>
    <div class="flex-container">
        <?php foreach ($data['recepts'] as $recept):?>
        <div class="flex-item">
                <div class="img-item">
                    <a href="<?= $link->url("home.recept", ['id' => $recept->getId()]) ?>"><img src="<?= FileStorage::UPLOAD_DIR . '/' . $recept->getImage() ?>" class="img" alt=""></a>
                </div>
                <div class="text-item">
                    <a class="recept-name" href="<?= $link->url("home.recept", ['id' => $recept->getId()]) ?>"><?= $recept->getName() ?></a>
                    <div>
                        <p class="ingredients">Ingrediencie: </p>
                        <ul>
                            <?php
                            $ingredients = explode("\n", $recept->getIngredients());
                            foreach ($ingredients as $ingredient) {
                                echo "<p>" .$ingredient. "</p>";
                            }
                            ?>
                        </ul>
                    </div>
                    <p>
                        <span class="bold">Priemerné hodnotenie: </span>
                        <?php
                        $finalRating = 0;
                        $successCount = 0;
                        $ratings = Rating::getAll($recept->getId());
                        if (count($ratings) > 0) {
                            foreach ($ratings as $rating) {
                                if ($recept->getId() == $rating->getReceptId()) {
                                    $finalRating += $rating->getRating();
                                    $successCount++;
                                }
                            }
                            if ($successCount > 0) {
                                $finalRating = $finalRating / $successCount;
                            }
                        }
                        echo "<span>".number_format($finalRating, 2)."/5</span>";
                        ?>
                    </p>
                    <?php if (($auth->isLogged() && $auth->getLoggedUserName() == $recept->getUserName()) || ($auth->isLogged() && $_SESSION['admin'] == 1)) : ?>
                    <a href="<?= $link->url('recept.edit', ['id' => $recept->getId()]) ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Upraviť</a>
                    <a href="<?= $link->url('recept.delete', ['id' => $recept->getId()]) ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Zmazať</a>
                    <?php endif; ?>
                </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.filter-text');
        const recipeContainer = document.querySelector('.flex-container');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                // Získajte vybrané kategórie
                const selectedCategories = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);
                const url = '<?= $link->url('home.filter') ?>';
                // AJAX volanie na server
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        ajax: 'filter_recipes',
                        categories: selectedCategories
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        // Zmazanie starých receptov
                        recipeContainer.innerHTML = '';

                        // Zobrazenie nových receptov
                        data.forEach(recipe => {
                            const recipeDiv = document.createElement('div');
                            recipeDiv.className = 'flex-item';
                            const ingredientsList = recipe.ingredients.split('\n').map(ingredient => {
                                return `<p>${ingredient}</p>`;
                            }).join('');
                            recipeDiv.innerHTML = `
                            <div class="img-item">
                                <a href="${recipe.url}">
                                    <img src="${recipe.image}" class="img" alt="">
                                </a>
                            </div>
                            <div class="text-item">
                                <a class="recept-name" href="${recipe.url}">${recipe.name}</a>
                                <div>
                                    <p class="ingredients">Ingrediencie: </p>
                                    <ul>
                                        ${ingredientsList}
                                    </ul>
                                </div>
                                <p>
                                    <span class="bold">Priemerné hodnotenie: </span>
                                    <span>${recipe.rating}/5</span>
                                </p>
                            <?php if (($auth->isLogged() && $auth->getLoggedUserName() == $recept->getUserName()) || ($auth->isLogged() && $_SESSION['admin'] == 1)) : ?>
                            <a href="<?= $link->url('recept.edit', ['id' => $recept->getId()]) ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Upraviť</a>
                            <a href="<?= $link->url('recept.delete', ['id' => $recept->getId()]) ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Zmazať</a>
                            <?php endif; ?>
                            </div>
                        `;
                            recipeContainer.appendChild(recipeDiv);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
</script>