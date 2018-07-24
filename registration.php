<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('ConnectionPDO.php');
$ini = parse_ini_file('config.ini');
$db = ConnectionPDO::getInstance();
if(isset($_POST['log']) && $_POST['log'] != '' && isset($_POST['pass']))
{
    $stmt = $db->prepare('SELECT * FROM users WHERE login = :login');
    $stmt->execute(array(':login' => $_POST["log"]));
    if (!empty($stmt->fetch(PDO::FETCH_LAZY)))
    {
        echo ("such user already exists in db, change login please");
    }
    else
    {
        $insStmt = $db->prepare('INSERT INTO users (login, pass, surname) VALUES (:login, :pass, :surname)');
        $insStmt->execute(array(':login' => $_POST['log'], ':pass' => md5($_POST["pass"].$ini['db_salt']),
            ':surname' => $_POST['surname']));
        $userId = $db->lastInsertId();
        session_start();
        $_SESSION['userId'] = $userId;
        header('Location: /index.php ');
    }
}
?>
<form action="" method="POST">
    <p>Log:<input type="text" name="log" value="<?=isset($_POST['log']) ? $_POST['log'] : ''?>" required></p>
    <p>Pass:<input type="text" name="pass" required></p>
    <p>Surname:<input type="text" name="surname" required></p>
    <button type="submit" name="register">Register</button>
</form>