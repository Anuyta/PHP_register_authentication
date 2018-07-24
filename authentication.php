<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    require_once('ConnectionPDO.php');
    $ini = parse_ini_file('config.ini');
    $db = ConnectionPDO::getInstance();
    if (isset($_POST['log']) && isset($_POST['pass']))
    {
        $stmt = $db->prepare('SELECT * FROM users WHERE login = :login AND pass = :pass');
        $stmt->execute(array(':login' => $_POST['log'], ':pass' => md5($_POST['pass'].$ini['db_salt'])));

        if (!empty($row = $stmt->fetch(PDO::FETCH_LAZY)))
        {
            session_start();
            $_SESSION['userId'] = $row['id_user'];
            header('Location: /index.php ');
        }
    }
?>
<form action="" method="POST">
    <p>Log:<input type="text" name="log" value="<?=isset($_POST['log']) ? $_POST['log'] : ''?>" required></p>
    <p>Pass:<input type="password" name="pass" required></p>
    <button type="submit" name="log_in">Log in</button>
</form>
<p><a href="/registration.php">Registration</a></p>