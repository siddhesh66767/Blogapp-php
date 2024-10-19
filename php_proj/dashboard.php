<?php
session_start();
include 'config.php';

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category']; // Get the selected category
    
    // Initialize imageName to null
    $imageName = null;

    // Check if an image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $imageName = time() . '_' . basename($image['name']); // Unique image name
        $targetDirectory = "uploads/"; // Directory to save the image
        $targetFile = $targetDirectory . $imageName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            // Insert post data including image path into the database
            $sql = "INSERT INTO posts (title, content, image, category) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $content, $targetDirectory . $imageName, $category]); // Save the path with uploads/
        } else {
            echo "<div class='alert alert-danger'>Error uploading the image.</div>";
        }
    }

    // If no image was uploaded, insert without image
    if (!$imageName) {
        $sql = "INSERT INTO posts (title, content, category) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $content, $category]);
    }

    header("Location: dashboard.php?msg=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Blog Dashboard</title>
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-5">
        <h1>Add Post</h1>
        <form method="POST" enctype="multipart/form-data"> <!-- Added enctype attribute -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="" disabled selected>Select a category</option>
                    <option value="Technology">Technology</option>
                    <option value="Food">Food</option>
                    <option value="Travel">Travel</option>   
                    <option value="Sports">Sports</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Upload Image</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Add Post</button>
        </form>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
            <script>
                alert('Post submitted successfully!');
            </script>
        <?php endif; ?>
    </div>

    <?php include 'foot.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
