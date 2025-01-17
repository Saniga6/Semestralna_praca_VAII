<?php
/** @var LinkGenerator $link */
/** @var Recept $recept */
/** @var Array $data */
/** @var IAuthenticator $auth */

use App\Core\IAuthenticator;
use App\Core\LinkGenerator;
use App\Helpers\FileStorage;
use App\Models\Recept;
use App\Models\Comment;

?>

<?php try {
    $recept = Recept::getOne($data['recept']->getId());
} catch (Exception $e) {
    echo $e->getMessage();
} ?>
<div class="component-holder">
    <div class="row g-0 row-holder">
        <div class="col-md-4 col-sm-6">
                <img src="<?= FileStorage::UPLOAD_DIR . '/' . $recept->getImage() ?>" class="image" alt="...">
        </div>
        <div class="col-md-8 col-sm-10">
            <div class="row g-0">
                <div class="col-6">
                    <h3>Ingrediencie:</h3>
                    <ul>
                        <?php
                        $ingredients = explode("\n", $recept->getIngredients());
                        foreach ($ingredients as $ingredient) {
                            echo "<p>" .$ingredient. "</p>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-6">
                    <h3>Recept:</h3>
                    <ul>
                        <?php
                        $procedures = explode("\n", $recept->getProcedure());
                        foreach ($procedures as $procedure) {
                            echo "<p>" .$procedure. "</p>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="rating-form" method="post">
    <div class="rating" id="rating">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="bi-star-fill" data-value="<?= $i ?>"></span>
        <?php endfor; ?>
    </div>

    <input type="hidden" name="rating" id="rating-value">
    <input type="hidden" name="recept_id" value="<?= $recept->getId() ?>">
    <div class="button">
        <button type="submit" class="btn btn-outline-primary">Poslať</button>
    </div>
    <div id="rating-message" class="button"></div>
</form>

<div class="comments-section">
    <form class="comment-form" action="<?= $link->url("comment.save") ?>" method="post">
        <input type="hidden" name="recept_id" value="<?= $recept->getId() ?>">
        <textarea class="comment" name="comment-text" placeholder="Napíš svoj komentár..."></textarea>
        <button class="btn btn-primary" type="submit"><i class="bi bi-"></i> Poslať</button>
    </form>
    <?php
    $comments = Comment::getAll();
    foreach ($comments as $comment):
    if ($comment->getReceptId() == $recept->getId()): ?>
    <?php
        $isEditable = false;
        if ($auth->isLogged()) {
            $isEditable = $auth->getLoggedUserId() == $comment->getUserName();
        }
        $isAdmin = false;
        if ($isEditable) {
            $isAdmin = $_SESSION['admin'] == 1;
        }
        if ($isEditable || $isAdmin): ?>
            <div class="comment-section">
                <form class="comment-form" method="post" action="<?= $link->url('comment.edit', ['id' => $comment->getId()]) ?>">
                    <div class="comment-container">
                        <textarea name="comment" class="comment"><?=$comment->getComment() ?></textarea>
                        <div class="comment-actions">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-pencil"></i> Upraviť</button>
                            <a href="<?= $link->url('comment.delete', ['id' => $comment->getId()]) ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Vymazať</a>
                        </div>
                    </div>
                </form>
            </div>
                <?php else: ?>
            </div>--!>
            <div class="comment-container">
                <span class="comment-text"><?= $comment->getComment() ?></span>
                <span class="comment-author">Komentoval: <?= $comment->getUserName() ?></span>
            </div>
                <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

<script>
    const stars = document.querySelectorAll('.bi-star-fill');
    const ratingValue = document.getElementById('rating-value');

    let currentRating = 0;

    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            const value = parseInt(star.dataset.value);
            console.log(`Hover on star: ${star.dataset.value}`);

            // Zvýraznenie hviezd
            stars.forEach((s, i) => {
                s.classList.toggle('hovered', i < value);
            });
        });

        star.addEventListener('mouseout', () => {
            // Zrušenie zvýraznenia hviezd
            stars.forEach(s => s.classList.remove('hovered'));
            console.log('Mouse out');
        });

        star.addEventListener('click', () => {
            const value = parseInt(star.dataset.value);
            console.log(`Selected star: ${star.dataset.value}`);
            currentRating = value;

            // Zamknutie vybraných hviezd
            stars.forEach((s, i) => {
                s.classList.toggle('selected', i < value);
            });

            ratingValue.value = currentRating;
        });
    });
</script>

<script>
    document.getElementById('rating-form').addEventListener('submit', function (event) {
        event.preventDefault();

        const ratingValue = currentRating;
        const receptId = document.querySelector('[name="recept_id"]').value;

        fetch('<?= $link->url("rating.save") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                rating: ratingValue,
                recept_id: receptId,
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Používateľ nie je prihlásený.') {
                    return this.location.href = '<?= $link->url('auth.login') ?>';
                }
                const messageContainer = document.getElementById('rating-message');
                messageContainer.textContent = data.message;
            })
            .catch(error => {
                console.error('Chyba pri overovaní hodnotenia:', error);
            });
    });
</script>

<script src="/js_bootstrap/bootstrap.bundle.min.js"></script>
