<?php
require_once('ConnectionPDO.php');
session_start();
if(empty($_POST['newDate']) || empty($_POST['newTask']))
{
    echo 'newDate or newTask is null';
}
else{
    $db = ConnectionPDO::getInstance();
    $insStmt = $db->prepare('INSERT INTO tasks (task_datetime, task, id_user) VALUES (:datetime, :task, :idUser)');
    $insStmt->execute(array(':datetime' => date('Y-m-d H:i', strtotime($_POST['newDate'])), ':task' => $_POST['newTask'],
        ':idUser' => $_SESSION['userId']));
}


