<?php

/**
 * Created by PhpStorm.
 * User: Pedja
 * Date: 26-Sep-16
 * Time: 18:29
 */
class connection
{
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli('localhost', 'admin_newb', 'tkpxKWn8Mt', 'admin_agregator');
	    //$this->connection = new mysqli('localhost', 'root', 'root', 'agregator');

        if ($this->connection->connect_error) {
            die("Greska pri konekciji: " . $this->connection->connect_error);

        }
        mysqli_query($this->connection, "SET NAMES utf8");
        mysqli_query($this->connection, "SET CHARACTER SET utf8");
        mysqli_query($this->connection, "SET COLLATION_CONNECTION='utf8_general_ci'");

    }

    /**
     * @return mysqli
     */
    public function getConnection()
    {
        return $this->connection;
    }


}
