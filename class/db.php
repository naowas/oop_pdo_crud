<?php

class Database
{
    protected $username = 'root';
    protected $password = '';
    protected $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=phpcrud', $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo 'Connection failed' . $e->getMessage();
        }
    }
}
