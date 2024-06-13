<?php
include '.\includes\functions.php';
$appFunctions = new ChatAppFunctions ();
session_start();

if (!$appFunctions->isUserLoggedIn()) 
{
    session_destroy();
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message_id = $_POST['message_id'];
    $user_id = $_SESSION['user_id'];

    $result = $appFunctions->deleteMessage($message_id, $user_id);
    echo $result;
}
?>
