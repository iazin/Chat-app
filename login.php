<?php
session_start();
require_once '.\includes\functions.php';
$appFunctions = new ChatAppFunctions ();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginSuccess = $appFunctions->login($username, $password);

    if ($loginSuccess) 
    {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $appFunctions->getUserId($username);
        header('Location: rooms.php');
        exit();
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat-app Login</title>
    <link rel="stylesheet" href=".\styles\styles.css">
    <link rel="stylesheet" href=".\styles\bootstrap.min.css">
    <link rel="stylesheet" href=".\styles\bootstrap-icons-1.11.3\font\bootstrap-icons.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Chat-app</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" id="themeToggle">Dark theme</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-5 text-center">Authentication</h2>
                <div class="form-shadow mt-4">
                    <form action="login.php" method="post">
                        <div class="form-group mb-3">
                            <label for="username"><i class="bi bi-person-fill"></i> Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password"><i class="bi bi-lock-fill"></i> Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                    </form>
                    <a href="./register.php">Don't have an account? Register</a>
                    <?php if (isset($loginSuccess) && !$loginSuccess): ?>
                        <p class="error-message mt-3">Authentication error. Try again.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src=".\scripts\bootstrap.min.js"></script>
    <script src=".\scripts\script.js"></script>
</body>
</html>
