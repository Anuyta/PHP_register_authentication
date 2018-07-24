<?php
session_start();
unset($_SESSION['userId']);
session_destroy();
echo ('You\'re logout');
?>
<p><a href="/index.php">Log in</a></p>