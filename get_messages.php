<?php
session_start();
require_once '.\includes\functions.php';
$appFunctions = new ChatAppFunctions();

if (!$appFunctions->isUserLoggedIn()) {
    echo 'Not authorized';
    exit();
}

$room_id = $_GET['room_id'] ?? null;
if (!$room_id) {
    echo 'Room not specified';
    exit();
}

$messages = $appFunctions->getMessagesByRoom($room_id);

foreach ($messages as $message) {
    echo '<div class="message-box">';
    echo '<div class="message-header"><strong>' . htmlspecialchars($message['username']) . ':</strong></div>';
    echo '<div class="message-content">' . htmlspecialchars($message['message']) . '</div>';
    if ($_SESSION['user_id'] == $message['user_id']) {
        echo '<div class="message-actions">';
        echo '<button class="btn btn-outline-primary btn-sm" onclick="editMessage(' . $message['id'] . ')">Редактировать</button> ';
        echo '<button class="btn btn-outline-danger btn-sm" onclick="deleteMessage(' . $message['id'] . ')">Удалить</button>';
        echo '</div>';
    }
    echo '</div>';
}
