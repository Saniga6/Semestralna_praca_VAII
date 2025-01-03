<?php
/** @var LinkGenerator $link */
/** @var Array $data */
/** @var Recept $recept */
use App\Core\LinkGenerator;
use App\Helpers\FileStorage;
use App\Models\Recept;

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
        <?php foreach ($data['recepts'] as $recept): ?>
        <div class="flex-item">
                <div class="img-item">
                    <a href="<?= $link->url("home.recept", ['id' => $recept->getId()]) ?>"><img src="<?= FileStorage::UPLOAD_DIR . '/' . $recept->getImage() ?>" class="img" alt=""></a>
                </div>
                <div class="text-item">
                    <a class="recept-name" href="<?= $link->url("home.recept", ['id' => $recept->getId()]) ?>"><?= $recept->getName() ?></a>
                    <div>
                        <p class="ingredients">Ingrediencie: </p>
                        <?= $recept->getIngredients() ?>
                    </div>
                    <p>
                        <span class="bold">Priemerné hodnotenie: </span>
                        <span>4/5</span>
                    </p>
                    <?php if ($auth->isLogged() && $auth->getLoggedUserName() == $recept->getUserName()) : ?>
                    <a href="<?= $link->url('recept.edit', ['id' => $recept->getId()]) ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Upraviť</a>
                    <a href="<?= $link->url('recept.delete', ['id' => $recept->getId()]) ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Zmazať</a>
                    <?php endif; ?>
                </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>