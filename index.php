<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat-app</title>
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

    <div class="bg d-flex align-items-center justify-content-center">
        <div class="text-center">
            <h1 class="mb-4">Welcome to Chat-app!</h1>
            <p class="lead mb-4">Free communication without restrictions!</p>
            <a href="login.php" class="btn btn-primary btn-lg"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            <a href="register.php" class="btn btn-success btn-lg"><i class="bi bi-box-arrow-in-right"></i> Registration</a>
        </div>
    </div>

    <script src=".\scripts\bootstrap.min.js"></script>
    <script src=".\scripts\script.js"></script>
</body>
</html>
