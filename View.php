<?php
session_start();
include 'config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ?");
$stmt->execute([$id]);
$note = $stmt->fetch();

if (!$note) {
    echo "Catatan tidak ditemukan.";
    exit;
}

// Increment view count
$stmt = $pdo->prepare("UPDATE notes SET views = views + 1 WHERE id = ?");
$stmt->execute([$id]);
?>

<h2>Catatan Anda:</h2>
<p><?= nl2br(htmlspecialchars($note['note'])) ?></p>
<p><em>Catatan ini hanya dapat dibaca sekali.</em></p>
<?php
session_start(); // Start the session
include 'config.php'; // Include your database configuration

// Check if a note ID is provided
if (isset($_GET['id'])) {
    $note_id = $_GET['id'];
    
    // Prepare and execute a statement to fetch the note
    $stmt = $pdo->prepare("SELECT note FROM notes WHERE id = ? AND user_id = ?");
    $stmt->execute([$note_id, $_SESSION['user_id']]); // Assuming user_id is stored in session
    $note = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$note) {
        die("Catatan tidak ditemukan atau Anda tidak memiliki akses.");
    }
} else {
    die("ID catatan tidak diberikan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Catatan - Notulensi Web</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Catatan Anda:</h2>
    <p><?= nl2br(htmlspecialchars($note['note'])) ?></p>
    <p><em>Catatan ini hanya dapat dibaca sekali.</em></p>
</body>
</html>