<?php
session_start();
require_once '.\includes\functions.php';
$appFunctions = new ChatAppFunctions();

if (!$appFunctions->isUserLoggedIn()) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_room'])) {
    $roomName = $_POST['room_name'];
    $appFunctions->createRoom($roomName);
    header('Location: rooms.php');
    exit();
}

$rooms = $appFunctions->getRooms();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat Rooms</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="./account.php">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1><i class="bi bi-house-door"></i> Chat Rooms</h1>
        <form method="post" action="rooms.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Room name" name="room_name" required>
                <button class="btn btn-primary" type="submit" name="create_room">
                    <i class="bi bi-plus-lg"></i> Create Room
                </button>
            </div>
        </form>
        <ul class="list-group">
            <?php foreach ($rooms as $room): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="chat.php?room_id=<?php echo $room['id']; ?>">
                        <i class="bi bi-chat-right-text"></i> <?php echo htmlspecialchars($room['name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src=".\scripts\bootstrap.min.js"></script>
    <script src=".\scripts\script.js"></script>
</body>
</html>
