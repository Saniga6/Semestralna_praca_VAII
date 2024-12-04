<form method="post" action="<?= $link->url("recept.save") ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= @$data['recept']?->getId() ?>">

    <label for="name" class="name ingredients">Názov receptu</label>
    <div class="input-group has-validation mb-3">
        <textarea class="name" aria-label="With textarea" name="name" id="recept-name"><?= @$data['recept']?->getName() ?></textarea>
    </div>

    <label for="ingredients" class="ingredients">Zoznam ingrediencií</label>
    <div class="input-group has-validation mb-3">
        <textarea class="ingredientos" aria-label="With textarea" name="ingredients" id="bulletTextarea"><?= empty(@$data['recept']?->getIngredients()) ? '• ' : @$data['recept']?->getIngredients() ?></textarea>
    </div>

    <label for="procedure" class="ingredients">Postup</label>
    <div class="input-group has-validation mb-3">
        <textarea class="procedure" aria-label="With textarea" name="procedure" id="bulletTextarea"><?= empty(@$data['recept']?->getProcedure()) ? '• ' : @$data['recept']?->getProcedure() ?></textarea>
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

    <script>
        // Funkcia pre nastavenie odrážky po každom stlačení Enter tlačidla
        document.querySelectorAll('#bulletTextarea').forEach(textarea => {
            textarea.addEventListener('keydown', function(event) {
                // Zabezpečenie, že prvá odrážka zostane neporušená
                if (textarea.value === '• ' && event.key === 'Backspace') {
                    event.preventDefault();
                    return;
                }

                //zabezpečenie, že sa kurzor posunie na pozíciu pred odrážkou
                const cursorPosition = textarea.selectionStart;
                const beforeCursor = textarea.value.substring(0, cursorPosition);
                const afterCursor = textarea.value.substring(cursorPosition);

                if (event.key === 'Tab') {
                    event.preventDefault();
                    textarea.value = beforeCursor + '    ' + afterCursor;
                    textarea.selectionStart = textarea.selectionEnd = cursorPosition + 4;
                }

                if (cursorPosition <= 2) {
                    textarea.selectionStart = textarea.selectionEnd = 2;
                }

                // Keď užívateľ stlačí Enter
                if (event.key === 'Enter') {
                    // Získať pozíciu kurzora
                    event.preventDefault();
                    let cursorPosition = textarea.selectionStart;

                    // Rozdeliť text na časť pred kurzorom a po kurzore
                    let beforeCursor = textarea.value.substring(0, cursorPosition);
                    let afterCursor = textarea.value.substring(cursorPosition);

                    // Vložiť odrážku a nový riadok
                    textarea.value = beforeCursor + '\n• ' + afterCursor;

                    // Nastaviť kurzor za odrážku
                    textarea.selectionStart = textarea.selectionEnd = cursorPosition + 3;
                } else if (textarea.value === '' && event.key !== 'Backspace') {
                    // Ak je textarea prázdna, automaticky vložiť prvú odrážku
                    textarea.value = '• ';
                    textarea.selectionStart = textarea.selectionEnd = 2;
                }
            });
        });
    </script>
</form>