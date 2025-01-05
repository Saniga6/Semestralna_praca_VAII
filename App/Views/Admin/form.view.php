<?php
?>

<form method="post" action="<?= $link->url("user.save") ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= @$data['recept']?->getId() ?>">

    <label for="name" class="name ingredients">Meno uživateľa</label>

