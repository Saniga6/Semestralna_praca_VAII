<?php

/** @var string $contentHTML */
/** @var IAuthenticator $auth */
/** @var LinkGenerator $link */

use App\Config\Configuration;
use App\Core\IAuthenticator;
use App\Core\LinkGenerator;

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../public/css/style_index.css?v=<?= time() ?>">
</head>
<body>

<nav class="navbar">
    <?php if (str_contains($_SERVER['REQUEST_URI'], '/?c=recept&a=add') !== false): ?>
        <div class="container-fluid">
            <a class="bi bi-house" href="<?= $link->url("home.index") ?>"> Home</a>
            <span class="navbar-brand">Pridaj nový recept</span>
        </div>
    <?php elseif (str_contains($_SERVER['REQUEST_URI'], '/?c=recept&a=edit') !== false): ?>
        <div class="container-fluid">
            <a class="bi bi-house" href="<?= $link->url("home.index") ?>"> Home</a>
            <span class="navbar-brand">Aktualizuj recept</span>
        </div>
    <?php elseif (str_contains($_SERVER['REQUEST_URI'], '/?c=home&a=recept') !== false): ?>
        <div class="container-fluid">
            <a class="bi bi-house" href="<?= $link->url("home.index") ?>"> Home</a>
            <span class="navbar-brand">Detail receptu</span>
        </div>
    <?php else: ?>
    <div class="container-fluid">
        <a class="bi bi-house" href="<?= $link->url("home.index") ?>"> Home</a>
        <?php if ($auth->isLogged()):?>
        <a class="bi bi-envelope filter-all-text" href="<?= $link->url("recept.add") ?>"> Pridať</a>
        <?php endif; ?>
        <span>Receptár</span>
        <?php if ($auth->isLogged()): ?>
            <div class="user_name">Prihlásený používateľ: <?= $auth->getLoggedUserName() ?></div>
            <a class="bi bi-box-arrow-right" href="<?= $link->url("auth.logout") ?>"> Odhlásenie</a>
        <?php else:?>
        <a class="bi bi-box-arrow-in-right" href="<?= Configuration::LOGIN_URL ?>"> Prihlásenie</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</nav>
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
</body>
</html>
