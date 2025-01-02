<?php

$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="form-container">
    <form class="form-signing" method="post" action="<?= $link->url("login") ?>">
        <H2>Prihlásenie</H2>
        <label for="text" class="no-margin">Meno</label>
        <label for="name">
            <input name="login" type="text" class="input-text form-input form-control" id="login" placeholder="Meno" required autofocus>
        </label>
        <label for="password" class="no-margin">Heslo</label>
        <input name="password" type="password" class="input-text form-input form-control" id="password" placeholder="Password" required>
        <button type="submit" name="submit" class="btn btn-outline-light login-button">Prihlásenie</button>
    </form>
</div>

<a href="<?= \App\Config\Configuration::HOME_URL ?>">
    <button type="submit" class="back-button btn btn-outline-light">Naspäť</button>
</a>

<script src="/js_bootstrap/bootstrap.bundle.min.js"></script>