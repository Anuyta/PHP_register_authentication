<?php
require_once('ConnectionPDO.php');
session_start();
if(empty($_POST['id']))
{
    echo 'id is null';
}
else {
    $db = ConnectionPDO::getInstance();
    $stmt = $db->prepare('DELETE FROM tasks WHERE id_task = :id AND id_user = :idUser');
    $stmt->execute(array('id' => $_POST['id'], 'idUser' => $_SESSION['userId']));
    echo  $stmt->rowCount();
}



