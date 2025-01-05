<?php

/** @var \App\Core\IAuthenticator $auth */

use App\Models\User; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div>
                <div class="container my-5">
                    <h2>Admin Panel - Správa Používateľov</h2>
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Meno</th>
                            <th>Admin</th>
                            <th>Možnosti</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php $users = User::getAll();
                             foreach ($users as $user):?>
                            <td><?=$user->getUserId()?></td>
                            <td><?=$user->getName()?></td>
                            <td><?=$user->getIsAdmin() == 1 ? "Áno" : "Nie"?></td>
                            <td>
                                <a href="<?= $link->url('admin.edit', ['id' => $user->getUserId()]) ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Upraviť</a>
                                <a href="<?= $link->url('admin.delete', ['id' => $user->getUserId()]) ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Zmazať</a>
                            </td>
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