<form method="post" action="<?= $link->url("recept.save") ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= @$data['recept']?->getId() ?>">

    <label for="name" class="name ingredients">Názov receptu</label>
    <div class="input-group has-validation mb-3">
        <textarea class="name expand" aria-label="With textarea" name="name" id="recept-name" required><?= @$data['recept']?->getName() ?></textarea>
    </div>

    <label for="ingredients" class="ingredients">Zoznam ingrediencií</label>
    <div class="input-group has-validation mb-3">
        <textarea class="ingredientos expand" aria-label="With textarea" name="ingredients" id="bulletTextarea" required><?= empty(@$data['recept']?->getIngredients()) ? '• ' : @$data['recept']?->getIngredients() ?></textarea>
    </div>

    <label for="procedure" class="ingredients">Postup</label>
    <div class="input-group has-validation mb-3">
        <textarea class="procedure expand" aria-label="With textarea" name="procedure" id="bulletTextarea" required><?= empty(@$data['recept']?->getProcedure()) ? '• ' : @$data['recept']?->getProcedure() ?></textarea>
    </div>

    <label for="categories" class="form-label">Kategórie</label>
    <?php
    function isChecked(string $value, string $categories): string {
        $arrayCategory = explode(",", $categories);
        return in_array($value, $arrayCategory) ? 'checked' : '';
    }
    ?>
    <div id="categories">
        <div>
            <label for="category-1">Mäsité
            <input type="checkbox" name="categories[]" id="category-1" value="Mäsité"
                <?php if(!empty($data)):?>
                    <?=isChecked("Mäsité", @$data['recept']?->getCategories());?>
                <?php endif;?>
            </label>
        </div>
        <div>
            <label for="category-2">Sladké
            <input type="checkbox" name="categories[]" id="category-2" value="Sladké"
                <?php if(!empty($data)):?>
                    <?=isChecked("Sladké", @$data['recept']?->getCategories());?>
                <?php endif;?>
            </label>
        </div>
        <div>
            <label for="category-3">Slané
                <input type="checkbox" name="categories[]" value="Slané"
                <?php if(!empty($data)):?>
                    <?=isChecked("Slané", @$data['recept']?->getCategories());?>
                <?php endif;?>
            </label>
        </div>
        <div>
            <label for="category-4">Tradičné
            <input type="checkbox" name="categories[]" id="category-4" value="Tradičné"
                <?php if(!empty($data)):?>
                    <?=isChecked("Tradičné", @$data['recept']?->getCategories());?>
                <?php endif;?>
            </label>
        </div>
        <div>
            <label for="category-5">Exotické
            <input type="checkbox" name="categories[]" id="category-5" value="Exotické"
                <?php if(!empty($data)):?>
                    <?=isChecked("Exotické", @$data['recept']?->getCategories());?>
                <?php endif;?>
            </label>
        </div>
        <div>
            <label for="category-6">Vegetariánske
            <input type="checkbox" name="categories[]" id="category-6" value="Vegetariánske"
                <?php if(!empty($data)):?>
                    <?=isChecked("Vegetariánske", @$data['recept']?->getCategories());?>
                <?php endif;?>
            </label>
        </div>
        <div>
            <label for="category-7">Vegánske
            <input type="checkbox" name="categories[]" id="category-7" value="Vegánske"
                <?php if(!empty($data)):?>
                    <?=isChecked("Vegánske", @$data['recept']?->getCategories());?>
                <?php endif;?>
            </label>
        </div>
    </div>

    <label for="image" class="form-label">Súbor obrázka</label>
    <?php if (@$data['recept']?->getImage() != ""): ?>
        <input type="file" class="image" name="image" id="recept-image" accept="image/png, image/jpeg" required>
        <div>Pôvodný súbor: <?= substr($data['recept']->getImage(), strpos($data['recept']->getImage(), '-') + 1);
        @$data['recept']->setImage(@$data['recept']?->getImage())?></div>
    <?php else: ?>
        <input type="file" class="image" name="image" id="recept-image" accept="image/png, image/jpeg" required>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary">Uložiť</button>

    <script>
        // Funkcia na automatické prispôsobenie výšky textarea podľa obsahu
        function autoExpandTextarea(textarea) {
            textarea.style.height = "auto";
            textarea.style.height = textarea.scrollHeight + "px";
        }

        // Pridanie event listenera pre všetky textarea na stránke
        document.addEventListener("input", function (event) {
            if (event.target.tagName === "TEXTAREA") {
                autoExpandTextarea(event.target);
            }
        });

        document.getElementById("recept-name").addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        });
    </script>

    <script>
        //Hľadanie všetkých textarea s id bulletTextarea
        document.querySelectorAll('#bulletTextarea').forEach(textarea => {
            // Funkcia pre nastavenie odrážky po každom stlačení Enter tlačidla
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
                    textarea.selectionStart = textarea.selectionEnd = cursorPosition + 4;
                } else if (textarea.value === '' && event.key !== 'Backspace') {
                    // Ak je textarea prázdna, automaticky vložiť prvú odrážku
                    textarea.value = '• ';
                    textarea.selectionStart = textarea.selectionEnd = 2;
                }
            });
        });
    </script>
</form>