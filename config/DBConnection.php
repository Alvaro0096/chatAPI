<?php

class DBConnection{
    protected $db_host = 'localhost';
    protected $db_name = 'chatBase';
    protected $db_user = 'root';
    protected $db_password = '';
    protected $port = '3307';
    protected $connection;

    protected function getConnection(){
        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . $this->db_host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->db_user, $this->db_password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "Connection failed: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
