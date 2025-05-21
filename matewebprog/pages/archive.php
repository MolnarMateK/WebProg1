<h2>Archívum</h2>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';

$query = "SELECT name, email, subject, message, submitted_at FROM messages ORDER BY submitted_at DESC";
$result = $db->query($query);

if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
?>
        <div class="mb-4 border p-3">
            <h4><?= htmlspecialchars($row['subject']) ?></h4>
            <p><strong>Név:</strong> <?= htmlspecialchars($row['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
            <p><strong>Üzenet:</strong> <?= nl2br(htmlspecialchars($row['message'])) ?></p>
            <p><em>Beküldve: <?= date("Y-m-d H:i:s", strtotime($row['submitted_at'])) ?></em></p>
        </div>
<?php
    endwhile;
else:
    echo "<p>Nincsenek üzenetek az archívumban.</p>";
endif;
?>
