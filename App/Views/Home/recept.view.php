<?php
/** @var LinkGenerator $link */
/** @var Recept $recept */
/** @var Array $data */

use App\Core\LinkGenerator;
use App\Helpers\FileStorage;
use App\Models\Recept;

?>

<?php try {
    $recept = Recept::getOne($data['recept']->getId());
} catch (Exception $e) {
    echo $e->getMessage();
} ?>
<div class="component-holder">
    <div class="row g-0 row-holder">
        <div class="col-md-4 col-sm-6">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?= FileStorage::UPLOAD_DIR . '/' . $recept->getImage() ?>" class="d-block w-100 image" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?= FileStorage::UPLOAD_DIR . '/' . $recept->getImage() ?>" class="d-block w-100 image" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?= FileStorage::UPLOAD_DIR . '/' . $recept->getImage() ?>" class="d-block w-100 image" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-md-8 col-sm-10">
            <div class="row g-0">
                <div class="col-6">
                    <h3>Ingrediencie:</h3>
                    <ul>
                        <?php
                        $ingredients = explode("\n", $recept->getIngredients());
                        foreach ($ingredients as $ingredient) {
                            echo "<p>" .$ingredient. "</p>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-6">
                    <h3>Recept:</h3>
                    <ul>
                        <?php
                        $procedures = explode("\n", $recept->getProcedure());
                        foreach ($procedures as $procedure) {
                            echo "<p>" .$procedure. "</p>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="post" action="<?= $link->url("rating.save") ?>">
    <div class="rating" id="rating">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="bi-star-fill" data-value="<?= $i ?>"></span>
        <?php endfor; ?>
    </div>

    <input type="hidden" name="rating" id="rating-value">
    <input type="hidden" name="recept_id" value="<?= $recept->getId() ?>">
    <div class="button">
        <button type="submit" class="btn btn-outline-primary">Poslať</button>
    </div>
</form>

<script>
    const stars = document.querySelectorAll('.bi-star-fill');
    const ratingValue = document.getElementById('rating-value');

    let currentRating = 0;

    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            const value = parseInt(star.dataset.value);

            // Zvýraznenie hviezd
            stars.forEach((s, i) => {
                s.classList.toggle('hovered', i < value);
            });
        });

        star.addEventListener('mouseout', () => {
            // Zrušenie zvýraznenia hviezd
            stars.forEach(s => s.classList.remove('hovered'));
        });

        star.addEventListener('click', () => {
            const value = parseInt(star.dataset.value);
            currentRating = value;

            // Zamknutie vybraných hviezd
            stars.forEach((s, i) => {
                s.classList.toggle('selected', i < value);
            });

            // Uloženie hodnotenia do skrytého inputu
            ratingValue.value = currentRating;
        });
    });
</script>

<script src="/js_bootstrap/bootstrap.bundle.min.js"></script>
