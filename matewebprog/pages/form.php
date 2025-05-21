<h2>Űrlapadatok</h2>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';

$is_logged_in = isset($_SESSION['username']);

if (isset($_SESSION['form_data'])):
    $form_data = $_SESSION['form_data'];

    // Ha be vagy jelentkezve, akkor a név session alapján
    if ($is_logged_in) {
        $nev = $_SESSION['username'];
    } else {
        $nev = 'Vendég';
    }
    ?>
    <div class="mb-3">
        <strong>Név:</strong> <?= htmlspecialchars($nev); ?>
    </div>
    <div class="mb-3">
        <strong>Email cím:</strong> <?= htmlspecialchars($form_data['email']); ?>
    </div>
    <div class="mb-3">
        <strong>Tárgy:</strong> <?= htmlspecialchars($form_data['subject']); ?>
    </div>
    <div class="mb-3">
        <strong>Üzenet:</strong> <?= nl2br(htmlspecialchars($form_data['message'])); ?>
    </div>

    <p><a href="index.php?page=contact" class="btn btn-secondary">Vissza az űrlaphoz</a></p>
    <hr>
    <?php
    unset($_SESSION['form_data']);
endif;
?>

<h3>Korábbi üzenetek</h3>

<?php
$result = $db->query("SELECT name, subject, message, submitted_at FROM messages ORDER BY submitted_at DESC");

if ($result && $result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
        ?>
        <div class="card mb-3">
            <div class="card-header">
                <strong><?= htmlspecialchars($row['name']); ?></strong>
                <span class="text-muted float-end"><?= htmlspecialchars($row['submitted_at']) ?></span>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['subject']) ?></h5>
                <p class="card-text"><?= nl2br(htmlspecialchars($row['message'])) ?></p>
            </div>
        </div>
    <?php endwhile;
else:
    echo "<p>Nincs még üzenet az adatbázisban.</p>";
endif;
?>
