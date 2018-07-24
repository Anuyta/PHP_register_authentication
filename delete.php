<?php
require_once('ConnectionPDO.php');
session_start();
if(empty($_POST['id']))
{
    echo 'id is null';
}
else {
    $db = ConnectionPDO::getInstance();
    $stmt = $db->prepare('DELETE FROM tasks WHERE id_task = :id');
    $stmt->execute([$_POST['id']]);
}



