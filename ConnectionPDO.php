<?php
class ConnectionPDO
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            $ini = parse_ini_file('config.ini');
            $dsn = 'mysql:host=' . $ini['db_host'] . ';dbname=' . $ini['db_name'];
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            self::$instance = new PDO($dsn, $ini['db_user'], $ini['db_pass'], $opt);
        }
        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}