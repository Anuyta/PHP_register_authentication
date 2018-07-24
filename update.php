<?php
require_once('ConnectionPDO.php');
session_start();
if(empty($_POST['updDate']) || empty($_POST['updTask']) || empty($_POST['id'])){
    echo 'updDate or updTask or id is null';
}
else{
    $db = ConnectionPDO::getInstance();
    $stmt = $db->prepare('UPDATE tasks SET task_datetime = :newDate, task = :newTask 
                WHERE id_task = :id AND id_user = :idUser');
    $stmt->execute(array('newDate' => $_POST['updDate'], 'newTask' => $_POST['updTask'], 'id' => $_POST['id'],
        'id_user' => $_SESSION['userId']));
}
