<?php

$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="form-container">
    <form class="form-signing" method="post" action="<?php $link->url("login") ?>">
        <H2>Prihlásenie</H2>
        <label for="text" class="no-margin">Meno</label>
        <label for="email">
            <input type="text" class="input-text form-input" id="login" placeholder="Meno">
        </label>
        <label for="password" class="no-margin">Heslo</label>
        <input type="password" class="input-text form-input" id="password" placeholder="Heslo">
        <button type="submit" class="btn btn-outline-light login-button">Prihlásenie</button>
    </form>
</div>

<a href="<?= \App\Config\Configuration::HOME_URL ?>">
    <button type="submit" class="back-button btn btn-outline-light">Naspäť</button>
</a>

<script src="/js_bootstrap/bootstrap.bundle.min.js"></script>

<!--<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Prihlásenie</h5>
                    <div class="text-center text-danger mb-3">
                        <?= @$data['message'] ?>
                    </div>
                    <form class="form-signin" method="post" action="<?= $link->url("login") ?>">
                        <div class="form-label-group mb-3">
                            <input name="login" type="text" id="login" class="form-control" placeholder="Login"
                                   required autofocus>
                        </div>

                        <div class="form-label-group mb-3">
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Password" required>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" name="submit">Prihlásiť
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
