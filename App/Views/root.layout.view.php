<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
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
    <?php if (str_contains($_SERVER['REQUEST_URI'], 'recept.add') !== false): ?>
        <div class="container-fluid">
            <span class="navbar-brand">Pridaj nový recept</span>
        </div>
    <?php elseif (str_contains($_SERVER['REQUEST_URI'], 'recept.edit') !== false): ?>
        <div class="container-fluid">
            <span class="navbar-brand">Aktualizuj recept</span>
        </div>
    <?php else: ?>
    <div class="container-fluid">
        <a class="bi bi-house" href="<?= $link->url("home.index") ?>"> Home</a>
        <a class="bi bi-envelope filter-all-text" href="<?= $link->url("recept.add") ?>"> Pridať</a>
        <span class="navbar-brand">Receptár</span>
        <a class="bi bi-box-arrow-in-right" href="<?= \App\Config\Configuration::LOGIN_URL ?>"> Prihlásenie</a>
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
