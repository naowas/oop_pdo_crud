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

class Func extends Database
{

    public function insert($data = array(), $table_name)
    {
        $columns = implode(", ", array_keys($data));
        $escaped_values = array_map(null, array_values($data));

        $values = "'" . implode("', '", $escaped_values) . "'";

        $sql = "INSERT INTO $table_name ($columns) VALUES ($values)";
        $query = $this->conn->prepare($sql);
        $query->execute();

        echo $columns . "<br/>";
        echo $values;

    }
}
