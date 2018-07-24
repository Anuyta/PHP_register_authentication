<?php
session_start();
require_once('ConnectionPDO.php');
$db = ConnectionPDO::getInstance();
$stmt = $db->prepare('SELECT * FROM tasks WHERE id_user = :id');
$stmt->execute(array($_SESSION['userId']));
$output = '';
$output .= '
 <table border="1" id="task-table" cellpadding="5px">
    <tr>
        <th>DateTime</th>
        <th>Task</th>
        <th colspan="2">Action</th>
    </tr>';

    $missDeadline = 60 * 60 * 24 * 5;
    while ($row = $stmt->fetch(PDO::FETCH_LAZY))
    {
        $output .= '
        <tr data-id="'.$row["id_task"].'">
            <td><input name="date" type="text" value="'.date("Y-m-d H:i", $row['task_datetime']).'"></td>
            <td><input name="task" type="text" value="'.$row["task"].'"></td>
            <td id="btn-upd"><button>Update</button></td>
            <td id="btn-del"><button>Delete</button></td>
        </tr>';
    }
$output .= '<tr>
        <td><input type="datetime-local" name="new-dateTime"></td>
        <td><input type="text" name="new-task"></td>
        <td colspan="2"><button id="btn-new">Add new</button></td>
    </tr>
</table>';

echo $output;