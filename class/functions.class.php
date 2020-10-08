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
            echo "<script>window.open('index.php','_self')</script>";
        }

    }

    public function edit($id)
    {
        $data = $this->conn->prepare("SELECT * FROM user_info WHERE id = :id");
        $data->execute(array(':id' => $id));

        foreach ($data as $value) {
            return $value;
        }

    }

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

            // print_r($valueSets);

        $sql = "UPDATE $table_name SET " . join(",", $valueSets) . " WHERE id = $id ";
        
        $query = $this->conn->prepare($sql);

        // print_r($query);
        // exit();

        $query->execute();


        }


        // $columns = implode(", ", array_keys($data));
        // $escaped_values = array_map(null, array_values($data));

        // $values = "'" . implode("', '", $escaped_values) . "'";

        // $sql = "UPDATE $table_name SET ($columns) VALUES  $values WHERE id = $id";
        // $query = $this->conn->prepare($sql);
        // var_dump($query);
        // $query->execute();
        // if ($query == true) {

        //     unlink($docfile_old);
        //     unlink($image_old);

        //     echo "<script>alert('Record updated with image and DOC file')</script>";
        //     echo "<script>window.open('index.php','_self')</script>";

        // }

    }

    // public function update($image_old, $docfile_old, $id)
    // {

    //     if (isset($_POST['update'])) {

    //         $name = $_POST['name'];
    //         $fname = $_POST['fname'];
    //         $mname = $_POST['mname'];
    //         $mobile = $_POST['mobile'];
    //         $email = $_POST['email'];
    //         $address = $_POST['address'];
    //         $gender = $_POST['gender'];
    //         $religion = $_POST['religion'];

    //         /// File Part
    //         $docfile = $_FILES["docfile"]["name"];
    //         $temp_doc = $_FILES["docfile"]["tmp_name"];
    //         $target_doc_dir = "uploads/";
    //         $target_doc_file = strtolower($target_doc_dir . basename($docfile));
    //         $doc_file_type = pathinfo($target_doc_file, PATHINFO_EXTENSION);

    //         if ($doc_file_type != "docx" && $doc_file_type != "ppt" && $doc_file_type != "pdf" && $doc_file_type != "xls") {
    //             echo "<script>alert('Docx, PPT, PDF and XLS files are allowed!')</script>";
    //         } else {
    //             $movfile = move_uploaded_file($temp_doc, $target_doc_file);
    //         }

    //         $image = $_FILES["image"]["name"];
    //         $temp_image = $_FILES["image"]["tmp_name"];
    //         $file_size = $_FILES["image"]["size"];
    //         $target_dir = "uploads/";
    //         $target_file = strtolower($target_dir . basename($image));
    //         $img_file_type = pathinfo($target_file, PATHINFO_EXTENSION);

    //         if ($img_file_type != "jpg" && $img_file_type != "png" && $img_file_type != "jpeg" && $img_file_type != "gif") {
    //             echo "<script>alert('jpg, png, jpeg and gif files are allowed!')</script>";

    //         } else {
    //             $move_img = move_uploaded_file($temp_image, $target_file);
    //         }

    //         $sql = "UPDATE user_info SET name = :name, fname = :fname, mname = :mname, mobile= :mobile, email=:email, address=:address, gender=:gender, religion=:religion, image_path=:image_path, docfile=:docfile  WHERE id = :id";
    //         $query = $this->conn->prepare($sql);
    //         $query->bindParam("name", $name, PDO::PARAM_STR);
    //         $query->bindParam("fname", $fname, PDO::PARAM_STR);
    //         $query->bindParam("mname", $mname, PDO::PARAM_STR);
    //         $query->bindParam("mobile", $mobile, PDO::PARAM_STR);
    //         $query->bindParam("email", $email, PDO::PARAM_STR);
    //         $query->bindParam("address", $address, PDO::PARAM_STR);
    //         $query->bindParam("gender", $gender, PDO::PARAM_STR);
    //         $query->bindParam("religion", $religion, PDO::PARAM_STR);
    //         $query->bindParam("image_path", $target_file, PDO::PARAM_STR);
    //         $query->bindParam("docfile", $target_doc_file, PDO::PARAM_STR);
    //         $query->bindParam("id", $id, PDO::PARAM_STR);
    //         $query->execute();

    //         if ($query == true) {
    //             unlink($docfile_old);
    //             unlink($image_old);
    //         }
    //         echo "<script>alert('Record Has been updated')</script>";
    //         echo "<script>window.open('index.php','_self')</script>";
    //     }
    // }
}
