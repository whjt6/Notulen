<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note = $_POST['note'];
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO notes (user_id, note) VALUES (?, ?)");
    $stmt->execute([$userId, $note]);

    $noteId = $pdo->lastInsertId();
    header("Location: view.php?id=$noteId");
}
?>

<form method="POST">
    <textarea name="note" placeholder="Tulis catatan Anda di sini..." required></textarea>
    <button type="submit">Buat Catatan</button>
</form>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Catatan - Notulensi Web</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form method="POST">
        <h2>Buat Catatan</h2>
        <textarea name="note" placeholder="Tulis catatan Anda di sini..." required></textarea>
        <button type="submit">Buat Catatan</button>
    </form>
</body>
</html>