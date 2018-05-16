<?php

namespace ProjectDesigner\Database;

use ProjectDesigner\Configuration;

/**
 * Connexion with a PostgreSQL database
 */
class MyDatabase implements IDatabase
{
    private $pdo;

    /**
     * @param      string  $host      Hostname
     * @param      string  $username  Login
     * @param      string  $password  Password
     * @param      string  $db        Database name
     */
    public function __construct($host, $db, $username, $password)
    {
        $this->pdo = new \PDO('mysql:host=' . $host . ';dbname=' . $db, $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function fromConfiguration(Configuration $config)
    {
        return new MyDatabase(
            $config->getDatabaseHost(),
            $config->getDatabaseName(),
            $config->getDatabaseLogin(),
            $config->getDatabasePasswd());
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function query($query)
    {
        try
        {
            return $this->pdo->query($query); // TODO:skeggib escape
        }

        catch (\Exception $e)
        {
            throw new \Exception("Query failed: " . $query . " -> " . $e->getMessage(), 0, $e);
        }
    }

    public function insertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function hash($password)
    {
        return md5($password);
    }
}
