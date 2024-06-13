<?php
include '.\includes\functions.php';
$appFunctions = new ChatAppFunctions ();
session_start();

if (!$appFunctions->isUserLoggedIn()) 
{
    session_destroy();
    header('Location: index.php');
    exit();
}

$id = $_POST['user_id'];
$appFunctions->deleteUser($id);
header('Location: index.php');
exit();
?>
