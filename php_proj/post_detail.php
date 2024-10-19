<?php
session_start();
include 'config.php';


$post_id = $_GET['id'] ?? null;

if ($post_id) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();

    if (!$post) {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

// Handle comment submission
if (isset($_POST['comment'])) {
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];

    $sql = "INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id, $user_id, $content]);
    header("Location: post_detail.php?id=" . $post_id);
    exit;
}

// Fetch comments for this post
$commentStmt = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ? ORDER BY created_at DESC");
$commentStmt->execute([$post_id]);
$comments = $commentStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container mt-5">
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <?php if (!empty($post['image'])): ?>
        <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image" class="img-fluid mb-3" style="max-width: 100%; height: auto;">
    <?php endif; ?>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
    <small class="text-muted"><?php echo $post['created_at']; ?></small>

    <hr>

    <h3>Comments</h3>
    <ul class="list-group mb-4">
        <?php foreach ($comments as $comment): ?>
            <li class="list-group-item">
                <strong><?php echo htmlspecialchars($comment['username']); ?>:</strong>
                <p><?php echo htmlspecialchars($comment['content']); ?></p>
                <small class="text-muted"><?php echo $comment['created_at']; ?></small>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if (isset($_SESSION['user_id'])): ?>
        <h4>Add a Comment</h4>
        <form method="POST">
            <div class="form-group">
                <textarea class="form-control" name="content" placeholder="Add your comment here..." required></textarea>
            </div>
            <button type="submit" name="comment" class="btn btn-primary">Submit</button>
        </form>
    <?php else: ?>
        <p class="text-muted">You must be logged in to comment.</p>
    <?php endif; ?>
</div>

<?php include 'foot.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
