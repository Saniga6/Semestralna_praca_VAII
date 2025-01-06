<?php

use App\Config\Configuration;
use App\Core\LinkGenerator;

$layout = 'auth';
/** @var Array $data */
/** @var LinkGenerator $link */


?>

<div class="form-container">
    <form class="form-register" method="post" action="<?= $link->url("user.save")?>">
        <H2>Registrácia</H2>
        <label for="text" class="no-margin">Meno</label>
        <label for="name">
            <input name="login" type="text" class="input-text form-input form-control" id="login" placeholder="Meno" required autofocus>
        </label>
        <label for="text" class="no-margin">Emailová adresa</label>
        <label for="email">
            <input name="email" type="email" class="input-text form-input form-control" id="email" placeholder="example@gmail.com" required>
        </label>
        <label for="password" class="no-margin">Heslo</label>
        <input name="password" type="password" class="input-text form-input form-control" id="password" placeholder="Password" required>
        <button type="submit" name="submit" class="btn btn-outline-light login-button">Registracia</button>
    </form>
    <a href="<?= Configuration::HOME_URL ?>">
        <button type="submit" class="back-button btn btn-outline-light">Naspäť</button>
    </a>
</div>
