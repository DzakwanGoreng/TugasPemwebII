<?php
session_start();
require_once 'Post.php';
$post = new Post();
$posts = $post->getPosts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-3">Blog Posts</h2>
	<?php if (isset($_SESSION['user_id'])): ?>
    <a href="create_post.php" class="btn btn-success mb-3">Buat Artikel</a>
<?php endif; ?>

    <table id="postsTable" class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['title']) ?></td>
                    <td><?= htmlspecialchars($p['username']) ?></td>
                    <td><?= $p['created_at'] ?></td>
                    <td><a href="view.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">View</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#postsTable').DataTable();
        });
    </script>
</body>
</html>
