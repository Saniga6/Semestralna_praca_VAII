<?php

use App\Config\Configuration;
use App\Core\LinkGenerator;

$layout = 'auth';
/** @var LinkGenerator $link */
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5">
            Odhlásili ste sa. <br>
            Znovu <a href="<?= Configuration::LOGIN_URL ?>">prihlásiť</a> alebo vrátiť sa <a
                    href="<?= $link->url("home.index") ?>">späť</a> na hlavnú stránku?
        </div>
    </div>
</div>
