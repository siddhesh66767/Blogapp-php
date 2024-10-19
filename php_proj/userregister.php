<?php
include 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username already exists
    $checkSql = "SELECT COUNT(*) FROM users WHERE username = ?";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([$username]);
    $userExists = $checkStmt->fetchColumn() > 0;

    if ($userExists) {
        $message = "User already exists.";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);
        $message = "Registration successful! Redirecting to login page...";
        echo "<script>
                setTimeout(function() {
                    window.location.href='userlogin.php';
                }, 2000);
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
        .show-password {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Register</h1>
    <form method="POST">
        <div class="form-group">
            <label for="username">Set Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Set Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <input type="checkbox" class="show-password" onclick="togglePassword()"> Show Password
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <?php if ($message): ?>
        <script>
            alert("<?php echo htmlspecialchars($message); ?>");
        </script>
    <?php endif; ?>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
