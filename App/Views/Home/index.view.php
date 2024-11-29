<?php
/** @var \App\Core\LinkGenerator $link */
?>

<div class="grid-container">
    <div class="filter">
        <div class="filter-all-text">
            <p class="filter-name">Filtrovanie</p>
            <div class="filter-text">
                <label for="option1"><input class="filter-text" type="checkbox" id="option1">Mäsité pokrmy</label>
                <label for="option2"><input class="filter-text" type="checkbox" id="option2">Sladké pokrmy</label>
            </div>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item">
            <div class="img-item">
                <a href="<?= $link->url("home.recept") ?>"><img src="../../../public/images/cake.png" class="img" alt="chocolate cake"></a>
            </div>
            <div class="text-item">
                <a class="recept-name" href="<?= $link->url("home.recept") ?>">Čokoládová torta</a>
                <p class="ingredients">Ingrediencie: </p>
                <p>
                    <span class="bold">Priemerné hodnotenie: </span>
                    <span>4/5</span>
                </p>
            </div>
        </div>

        <div class="flex-item">
            <div class="img-item">
                <a href="<?= $link->url("home.recept") ?>"><img src="../../../public/images/cake.png" class="img" alt="chocolate cake"></a>
            </div>
            <div class="text-item">
                <a class="recept-name" href="<?= $link->url("home.recept") ?>">Čokoládová torta</a>
                <p class="ingredients">Ingrediencie: </p>
                <p>
                    <span class="bold">Priemerné hodnotenie: </span>
                    <span>3/5</span>
                </p>
            </div>
        </div>

        <div class="flex-item">
            <div class="img-item">
                <a href="<?= $link->url("home.recept") ?>"><img src="../../../public/images/cake.png" class="img" alt="chocolate cake"></a>
            </div>
            <div class="text-item">
                <a class="recept-name" href="<?= $link->url("home.recept") ?>">Čokoládová torta</a>
                <p class="ingredients">Ingrediencie: </p>
                <p>
                    <span class="bold">Priemerné hodnotenie: </span>
                    <span>2/5</span>
                </p>
            </div>
        </div>

        <div class="flex-item">
            <div class="img-item">
                <a href="<?= $link->url("home.recept") ?>"><img src="../../../public/images/cake.png" class="img" alt="chocolate cake"></a>
            </div>
            <div class="text-item">
                <a class="recept-name" href="<?= $link->url("home.recept") ?>">Čokoládová torta</a>
                <p class="ingredients">Ingrediencie: </p>
                <p>
                    <span class="bold">Priemerné hodnotenie: </span>
                    <span>1/5</span>
                </p>
            </div>
        </div>
    </div>
</div>