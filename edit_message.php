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
    $new_message = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    $result = $appFunctions->editMessage($message_id, $new_message, $user_id);
    echo $result;
}
?>
