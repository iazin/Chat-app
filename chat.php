<?php
session_start();
require_once '.\includes\functions.php';
$appFunctions = new ChatAppFunctions();

if (!$appFunctions->isUserLoggedIn()) {
    header('Location: login.php');
    exit();
}

$room_id = $_GET['room_id'] ?? null;
if (!$room_id) {
    header('Location: rooms.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_message'])) {
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];
    $appFunctions->postMessage($user_id, $room_id, $message);
    header('Location: chat.php?room_id=' . $room_id);
    exit();
}

$messages = $appFunctions->getMessagesByRoom($room_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat Room</title>
    <link rel="stylesheet" href=".\styles\styles.css">
    <link rel="stylesheet" href=".\styles\bootstrap.min.css">
    <link rel="stylesheet" href=".\styles\bootstrap-icons-1.11.3\font\bootstrap-icons.min.css">
    <script src=".\scripts\jquery-3.7.1.min.js"></script>
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
        <h1><i class="bi bi-chat-dots"></i> Chat Room <?php echo $room_id;?></h1>
        <div id="messages" class="mb-3">
        </div>
        <form method="post" action="chat.php?room_id=<?php echo $room_id; ?>">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Type a message..." name="message" required>
                <button class="btn btn-primary" type="submit" name="post_message">
                    <i class="bi bi-send"></i> Send
                </button>
            </div>
        </form>
        <br>
        <a href="rooms.php" class="btn btn-primary">
            <i class="bi bi-arrow-left-circle"></i> Back to list of rooms
        </a>
    </div>

    <script>
        function fetchMessages() {
            $.ajax({
                url: 'get_messages.php?room_id=<?php echo $room_id; ?>',
                type: 'GET',
                success: function(data) {
                    $('#messages').html(data);
                }
            });
        }

        $(document).ready(function() {
            fetchMessages();
            setInterval(fetchMessages, 5000);
        });
    </script>

    <script src=".\scripts\bootstrap.min.js"></script>
    <script src=".\scripts\script.js"></script>
</body>
</html>
