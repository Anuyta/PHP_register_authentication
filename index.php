<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
if (!isset($_SESSION['userId']))
{
    header('Location: /authentication.php ');
}
?>
<div id="task-data">
</div>
<div id="error-data" style="color: red">
</div>
<p><a href="/logout.php">Log out</a></p>

<script src="js/jquery-3.3.1.js"></script>
<script src="js/script.js"></script>
