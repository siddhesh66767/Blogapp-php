<?php
session_start();

print_r($_SESSION);

include 'config.php'; // Include your database connection

// Check if the user is an admin
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect if not an admin
    exit;
}

// Handle blog post deletion
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
    $stmt->execute([$post_id]);
    header('Location: admin_panel.php');
    exit;
}

// Handle blog post creation
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $pdo->prepare('INSERT INTO posts (title, content) VALUES (?, ?)');
    $stmt->execute([$title, $content]);
    header('Location: admin_panel.php');
    exit;
}

// Handle blog post update
if (isset($_POST['update'])) {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $pdo->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
    $stmt->execute([$title, $content, $post_id]);
    header('Location: admin_panel.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Add custom CSS here -->
    <title>Admin Panel</title>
    <style>
        /* Custom CSS for Cards and Animation */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-title {
            color: #007bff;
        }

        .card-body {
            background-color: #f8f9fa;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 20px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            color: #ff4d4d;
        }

        .update-btn {
            color: #28a745;
        }

        .create-form, .update-form {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- Include Navbar -->
<?php include 'nav.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Admin Panel - Manage Blog Posts</h1>

    <!-- Create New Post Form -->
    <div class="create-form mb-5">
        <h3>Create New Post</h3>
        <form method="POST">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter content" required></textarea>
            </div>
            <button type="submit" name="create" class="btn btn-custom">Create Post</button>
        </form>
    </div>

    <!-- Display Blog Posts in Cards -->
    <div class="row">
        <?php
        $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
        while ($row = $stmt->fetch()) {
            echo "
            <div class='col-md-4 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>
                        <p class='card-text'>" . htmlspecialchars($row['content']) . "</p>
                        <p class='card-text'><small class='text-muted'>" . $row['created_at'] . "</small></p>
                        <button class='btn btn-link update-btn' data-toggle='modal' data-target='#updateModal" . $row['id'] . "'>Edit</button>
                        <a href='admin_panel.php?delete=" . $row['id'] . "' class='btn btn-link delete-btn' onclick='return confirm(\"Are you sure you want to delete this post?\");'>Delete</a>
                    </div>
                </div>
            </div>";

            // Update Modal for each post
            echo "
            <div class='modal fade' id='updateModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='updateModalLabel" . $row['id'] . "' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='updateModalLabel" . $row['id'] . "'>Edit Post</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <form method='POST'>
                                <input type='hidden' name='post_id' value='" . $row['id'] . "'>
                                <div class='form-group'>
                                    <label for='title'>Post Title</label>
                                    <input type='text' class='form-control' name='title' value='" . htmlspecialchars($row['title']) . "' required>
                                </div>
                                <div class='form-group'>
                                    <label for='content'>Content</label>
                                    <textarea class='form-control' name='content' rows='3' required>" . htmlspecialchars($row['content']) . "</textarea>
                                </div>
                                <button type='submit' name='update' class='btn btn-custom'>Update Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</div>

<!-- Include Footer -->
<?php include 'foot.php'; ?>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
