<form method="post" action="<?= $link->url("recept.save") ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= @$data['recept']?->getId() ?>">

    <label for="name" class="name">Názov receptu</label>
    <div class="input-group has-validation mb-3">
        <textarea class="name" aria-label="With textarea" name="name" id="recept-name"><?= @$data['recept']?->getName() ?></textarea>
    </div>

    <label for="ingredients" class="ingredients">Zoznam ingrediencií</label>
    <div class="input-group has-validation mb-3">
        <textarea class="ingredients" aria-label="With textarea" name="ingredients" id="recept-ingredients"><?= @$data['recept']?->getIngredients() ?></textarea>
    </div>

    <label for="procedure" class="ingredients">Postup</label>
    <div class="input-group has-validation mb-3">
        <textarea class="procedure" aria-label="With textarea" name="procedure" id="recept-procedure"><?= @$data['recept']?->getProcedure() ?></textarea>
    </div>

    <label for="image" class="form-label">Súbor obrázka</label>
    <?php if (@$data['recept']?->getImage() != ""): ?>
        <input type="file" class="image" name="image" id="recept-image" accept="image/png, image/jpeg">
        <div>Pôvodný súbor: <?= substr($data['recept']->getImage(), strpos($data['recept']->getImage(), '-') + 1);
        @$data['recept']->setImage(@$data['recept']?->getImage())?></div>
    <?php else: ?>
        <input type="file" class="image" name="image" id="recept-image" accept="image/png, image/jpeg">
    <?php endif; ?>

    <button type="submit" class="btn btn-primary">Uložiť</button>
</form>