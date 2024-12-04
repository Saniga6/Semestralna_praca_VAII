<?php
/** @var \App\Core\LinkGenerator $link */
/** @var Recept $recept */
/** @var Array $data */

use App\Helpers\FileStorage;
use App\Models\Recept;

?>

<?php $recept = \App\Models\Recept::getOne($data['recept']->getId()) ?>
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
                    <p class="recept-text"><?= $recept->getIngredients() ?></p>
                </div>
                <div class="col-6">
                    <h3>Recept:</h3>
                    <p class="recept-text"><?= $recept->getProcedure() ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="rating">
    <span class="bi-star-fill checked"></span>
    <span class="bi-star-fill checked"></span>
    <span class="bi-star-fill checked"></span>
    <span class="bi-star-fill"></span>
    <span class="bi-star-fill"></span>
</div>

<div class="button">
    <button type="button" class="btn btn-outline-primary">Poslať</button>
</div>

<script src="/js_bootstrap/bootstrap.bundle.min.js"></script>
