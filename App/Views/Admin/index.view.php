<?php

/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */

use App\Models\User; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div>
                <div class="container my-5">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Meno</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <th>Možnosti</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php $users = User::getAll();
                             foreach ($users as $user):?>
                            <td><?=$user->getUserId()?></td>
                            <form method="post" action="<?= $link->url('admin.save', ['id' => $user->getUserId()]) ?>">
                            <td><?=$user->getName()?></td>
                            <td><?=$user->getEmail()?></td>
                            <td>
                                <input type="checkbox" name="admin" <?=$user->getIsAdmin() == 1 ? 'Checked' : ''?>>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> Upraviť</button>
                                <a href="<?= $link->url('admin.delete', ['id' => $user->getUserId()]) ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Zmazať</a>
                            </td>
                            </form>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>