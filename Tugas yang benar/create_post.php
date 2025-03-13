<?php
session_start();
require_once 'Post.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = new Post();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    if ($post->createPost($title, $content, $user_id)) {
        echo "<script>alert('Artikel berhasil dibuat!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal membuat artikel.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buat Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Buat Artikel Baru</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Judul:</label>
            <input type="text" name="title" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Konten:</label>
            <textarea name="content" required class="form-control" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Buat Artikel</button>
    </form>
</body>
</html>
