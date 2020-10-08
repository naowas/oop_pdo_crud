<?php
include "db.php";

class Functions extends Database
{

    public function insert($data = array(), $table_name)
    {
        $columns = implode(", ", array_keys($data));
        $escaped_values = array_map(null, array_values($data));

        $values = "'" . implode("', '", $escaped_values) . "'";

        $sql = "INSERT INTO $table_name ($columns) VALUES ($values)";
        $query = $this->conn->prepare($sql);
        $query->execute();
        if ($query == true) {
            echo "<script>alert('Record Added with image and DOC file')</script>";
            echo "<script>window.open('index.php','_self')</script>";

        }
    }

    public function fetch($table_name)
    {

        $query = "SELECT * FROM $table_name";
        return $data = $this->conn->query($query);
    }

    public function delete($id, $table_name, $filepath_img, $filepath_doc)
    {
        $query = $this->conn->prepare("DELETE FROM $table_name WHERE id = :delete_id");
        $query->bindParam("delete_id", $id, PDO::PARAM_STR);
        $query->execute();
        if ($query == true) {
            unlink($filepath_img);
            unlink($filepath_doc);
            echo "<script>alert('Record Deleted')</script>";
            // echo "<script>window.open('index.php','_self')</script>";
        }

    }

    // public function edit($id)
    // {
    //     $data = $this->conn->prepare("SELECT * FROM user_info WHERE id = :id");
    //     $data->execute(array(':id' => $id));

    //     foreach ($data as $value) {
    //         return $value;
    //     }

    // }

    public function viewbyid($id, $table_name)
    {
        $data = $this->conn->prepare("SELECT * FROM $table_name WHERE id = :id");
        $data->execute(array(':id' => $id));

        foreach ($data as $value) {
            return $value;
        }

    }

    public function update($data, $table_name, $image_old, $docfile_old, $id)
    {

        $valueSets = array();
        foreach ($data as $key => $value) {
            $valueSets[] = $key . " = '" . $value . "'";

            $sql = "UPDATE $table_name SET " . join(",", $valueSets) . " WHERE id = $id ";
            $query = $this->conn->prepare($sql);
            $query->execute();

            if ($query == true) {

                unlink($docfile_old);
                unlink($image_old);

                echo "<script>alert('Record updated with image and DOC file')</script>";
                echo "<script>window.open('index.php','_self')</script>";

            }

        }

    }

}
