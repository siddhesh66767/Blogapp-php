<?php
session_start();
include 'config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $message]);

    // Redirect to a thank you page or show a success message
    header("Location: contact.php?msg=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Contact Us</title>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container mt-5">
    <h1>Contact Us</h1>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <div class="alert alert-success" role="alert">
            Your message has been sent successfully!
        </div>
    <?php endif; ?>

    <form method="POST" class="mb-4">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>

    <h2>Contact Information</h2>
    <p><address>Address: Thakur Village Kandivali Mumbai:400101</Address><a href="mailto:info@example.com">Gmail us at: sidxyz@gmail.com</a>.</p>
    
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4054.715295516609!2d72.87462475150355!3d19.210051548711416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b73839c7d58f%3A0xb41bbca10e44403b!2sThakur%20Cinema!5e0!3m2!1sen!2sin!4v1728915849319!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <p>For more details, visit our <a href="about.php">About Us</a> page.</p>
</div>

<?php include 'foot.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
