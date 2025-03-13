<?php
session_start();
require_once 'Post.php';
require_once 'Comment.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$post = new Post();
$comment = new Comment();
$article = $post->getPost($_GET['id']);
$comments = $comment->getComments($_GET['id']);

if (!$article) {
    echo "<script>alert('Artikel tidak ditemukan.'); window.location.href='index.php';</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $comment->addComment($_GET['id'], $_SESSION['user_id'], $_POST['content']);
    header("Location: view.php?id=" . $_GET['id']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2><?= htmlspecialchars($article['title']) ?></h2>
    <p><small>Diposting pada: <?= $article['created_at'] ?></small></p>
    <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>

    <hr>
    <h4>Komentar</h4>
    <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST">
            <div class="mb-3">
                <textarea name="content" required class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Komentar</button>
        </form>
    <?php else: ?>
        <p><a href="login.php">Login</a> untuk berkomentar.</p>
    <?php endif; ?>

    <ul class="list-group mt-3">
        <?php foreach ($comments as $c): ?>
            <li class="list-group-item">
                <strong><?= htmlspecialchars($c['username']) ?>:</strong>
                <p><?= nl2br(htmlspecialchars($c['content'])) ?></p>
                <small><?= $c['created_at'] ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
