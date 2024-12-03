<?php
/** @var \App\Core\LinkGenerator $link */
/** @var Recept $recept */
/** @var Array $data */

use App\Helpers\FileStorage;

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
                    <p class="recept-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dignissim ipsum nec est laoreet luctus. Vivamus id tristique libero, a elementum sem. Maecenas ornare eleifend rhoncus. Sed in erat vel sapien luctus pellentesque condimentum ut justo. Donec ornare leo eget porta posuere. Phasellus vehicula turpis a nunc fringilla volutpat a vel dolor. Quisque pharetra pulvinar est sit amet placerat. Phasellus vitae vulputate augue. Integer molestie dolor quis nunc commodo, at euismod ex cursus. Quisque dolor neque, luctus dignissim hendrerit ac, euismod sit amet tortor. Etiam tincidunt, nulla quis ornare malesuada, ipsum orci efficitur elit, sed malesuada turpis ante in lacus. Morbi interdum eros sit amet tellus semper, eget sodales justo pretium.</p>
                </div>
                <div class="col-6">
                    <h3>Recept:</h3>
                    <p class="recept-text">Quisque quis ornare massa, at pharetra lacus. Suspendisse dignissim consequat massa, id blandit erat consectetur nec. Integer purus eros, eleifend ut sapien pellentesque, dictum viverra quam. Praesent aliquet nibh leo. Morbi euismod turpis eu arcu porttitor tincidunt. Maecenas porta nec nisl ac rhoncus. Nullam pretium, libero non viverra faucibus, purus felis dictum arcu, ut fringilla augue massa et nisl. Proin mattis est eu sem vulputate lobortis. Nulla lacinia tempor auctor. Aenean semper nulla et sapien varius, in facilisis leo porttitor. Vivamus varius mi malesuada, tempus neque pulvinar, sodales sem. Donec eu sem in orci bibendum hendrerit. Aenean et ante tempus, blandit nunc at, vulputate enim. Cras egestas maximus interdum.
                    </p>
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
