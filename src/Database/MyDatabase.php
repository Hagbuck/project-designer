<?php

/**
 * Connexion with a PostgreSQL database
 */
class MyDatabase
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
        try
        {
            $dbconnect = 'mysql:dbname=' . $db . ';host=' . $host;
            $this->pdo = new \PDO($dbconnect, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage() . '<br />';
            $this->pdo = null;
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function query($query)
    {
        if($this->pdo != null)
        {
            try
            {
                return $this->pdo->query($query);
            }

            catch (\Exception $e)
            {
                throw new \Exception("Query failed: " . $query . " -> " . $e->getMessage(), 0, $e);
            }
        }
        else
        {
            echo 'PDO doesn\'t exist<br />';
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
?>
