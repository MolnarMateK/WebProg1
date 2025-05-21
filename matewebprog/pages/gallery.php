<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_logged_in = isset($_SESSION['user_id']);
$upload_dir = __DIR__ . '/../uploads/';
$upload_url = 'uploads/';
$images = is_dir($upload_dir) ? array_diff(scandir($upload_dir), ['.', '..']) : [];
?>

<h2 class="mb-4">Galéria</h2>

<?php if (isset($_SESSION['upload_error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['upload_error'] ?></div>
    <?php unset($_SESSION['upload_error']); ?>
<?php endif; ?>

<?php if (empty($images)): ?>
    <p>Még nincsenek feltöltött képek.</p>
<?php else: ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5">
        <?php foreach ($images as $img): ?>
            <div class="col">
                <div class="card bg-dark text-light h-100">
                    <img src="<?= $upload_url . $img ?>" class="card-img-top" alt="Feltöltött kép">
<?php if ($is_logged_in): ?>
    <form action="delete_image.php" method="GET" onsubmit="return confirm('Biztosan törlöd ezt a képet?');" class="mt-2 text-center">
        <input type="hidden" name="file" value="<?= htmlspecialchars($img) ?>">
        <button type="submit" class="btn btn-sm btn-danger">Törlés</button>
    </form>
<?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h4 class="mb-3">Kép feltöltése</h4>

<?php if ($is_logged_in): ?>
    <form action="uploads.php" method="POST" enctype="multipart/form-data" class="mb-5">
        <div class="mb-3">
            <input type="file" name="image" accept="image/*" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Feltöltés</button>
    </form>
<?php else: ?>
    <div class="alert alert-warning">Be kell jelentkezned a feltöltéshez.</div>
<?php endif; ?>
