<?php
session_start();
include 'config.php';


if (isset($_POST['comment'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];

    $sql = "INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id, $user_id, $content]);
    header("Location: index.php");
}

// Handle post edit
if (isset($_POST['edit_post'])) {
    $post_id = $_POST['post_id'];
    $new_title = $_POST['new_title'];
    $new_content = $_POST['new_content'];

    // Initialize imagePath to keep the existing image
    $imagePath = '';

    // Handle image upload
    if ($_FILES['new_image']['error'] == UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['new_image']['name']);
        $imagePath = 'uploads/' . $imageName;
        move_uploaded_file($_FILES['new_image']['tmp_name'], $imagePath);
    } else {
        // Keep the existing image if no new image is uploaded
        $stmt = $pdo->prepare("SELECT image FROM posts WHERE id = ?");
        $stmt->execute([$post_id]);
        $imagePath = $stmt->fetchColumn();
    }

    $sql = "UPDATE posts SET title = ?, content = ?, image = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$new_title, $new_content, $imagePath, $post_id]);
    header("Location: index.php");
}

// Handle post delete
if (isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];

    $stmt = $pdo->prepare("SELECT image FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);
    $imageName = $stmt->fetchColumn();

    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id]);

    if ($imageName) {
        $filePath = 'uploads/' . $imageName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    header("Location: index.php?msg=deleted");
}

// Get selected category if any
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

// Fetch posts based on selected category
if ($selectedCategory) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE category = ? ORDER BY created_at DESC");
    $stmt->execute([$selectedCategory]);
} else {
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Blog</title>
</head>
<body>

<?php include 'nav.php'; ?>
<div class="container mt-2">
    <h1>Blog Posts</h1>
    <form method="GET" class="mb-4">
        <div class="form-group">
            <label for="category">Filter by Category</label>
            <select class="form-control" id="category" name="category" onchange="this.form.submit()">
                <option value="" disabled <?= !$selectedCategory ? 'selected' : '' ?>>Select a category</option>
                <option value="Technology" <?= $selectedCategory == 'Technology' ? 'selected' : '' ?>>Technology</option>
                <option value="Food" <?= $selectedCategory == 'Food' ? 'selected' : '' ?>>Food</option>
                <option value="Travel" <?= $selectedCategory == 'Travel' ? 'selected' : '' ?>>Travel</option>
                <option value="Sports" <?= $selectedCategory == 'Sports' ? 'selected' : '' ?>>Sports</option>
            </select>
        </div>
    </form>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
        <div class="alert alert-success" role="alert">
            Post has been deleted successfully.
        </div>
    <?php endif; ?>

    <ul class="list-group">
    <?php
    while ($row = $stmt->fetch()) {
        $content = htmlspecialchars($row['content']);
        $wordCount = str_word_count($content);
        echo "<li class='list-group-item'>";
        echo "<h5>" . htmlspecialchars($row['title']) . "</h5>";

        // Check if content exceeds 20 words
        if ($wordCount > 20) {
            echo "<p>" . implode(' ', array_slice(explode(' ', $content), 0, 20)) . "... <a href='post_detail.php?id=" . $row['id'] . "'>Read more</a></p>";
        } else {
            echo "<p>" . $content . "</p>";
        }

        if (!empty($row['image'])) {
            echo "<img src='". htmlspecialchars($row['image']) . "' alt='Post Image' class='img-fluid mb-3' style='max-width: 100%; height: auto;'>";
        }
        echo "<small class='text-muted'>" . $row['created_at'] . "</small>"; 
        echo "<br/>";

        // Admin buttons for edit and delete
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            echo "<button class='btn btn-warning mt-2 mr-2' data-toggle='modal' data-target='#editModal" . $row['id'] . "'>Edit</button>";
            echo "<button class='btn btn-danger mt-2' data-toggle='modal' data-target='#deleteModal" . $row['id'] . "'>Delete</button>";
        }

        echo "</li>";

        // Edit Modal
        echo "<div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='editModalLabel'>Edit Post</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <form method='POST' enctype='multipart/form-data'>
                                <input type='hidden' name='post_id' value='" . $row['id'] . "'>
                                <div class='form-group'>
                                    <label for='new_title'>Title</label>
                                    <input type='text' class='form-control' name='new_title' value='" . htmlspecialchars($row['title']) . "' required>
                                </div>
                                <div class='form-group'>
                                    <label for='new_content'>Content</label>
                                    <textarea class='form-control' name='new_content' required>" . htmlspecialchars($row['content']) . "</textarea>
                                </div>
                                <div class='form-group'>
                                    <label for='new_image'>Upload New Image (optional)</label>
                                    <input type='file' class='form-control-file' name='new_image'>
                                </div>
                                <button type='submit' name='edit_post' class='btn btn-primary'>Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";

        // Delete Modal
        echo "<div class='modal fade' id='deleteModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='deleteModalLabel'>Delete Post</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            Are you sure you want to delete this post?
                        </div>
                        <div class='modal-footer'>
                            <form method='POST'>
                                <input type='hidden' name='post_id' value='" . $row['id'] . "'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                                <button type='submit' name='delete_post' class='btn btn-danger'>Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";
    }
    ?>
    </ul>
</div>

<?php include 'foot.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
