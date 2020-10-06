<?php
include "db.php";

class Functions extends Database
{

    public function insert()
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $religion = $_POST['religion'];
            $agree = $_POST['agree'];

            $image = $_FILES["image"]["name"];
            $temp_image = $_FILES["image"]["tmp_name"];
            $file_size = $_FILES["image"]["size"];
            $target_dir = "uploads/";
            $target_file = strtolower($target_dir . basename($image));
            $upload_ok = 1;
            $img_file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            /// File Part
            $docfile = $_FILES["docfile"]["name"];
            $temp_doc = $_FILES["docfile"]["tmp_name"];
            $file_size = $_FILES["docfile"]["size"];
            $target_doc_dir = "uploads/";
            $target_doc_file = strtolower($target_doc_dir . basename($docfile));
            $movfile = 1;
            $doc_file_type = pathinfo($target_doc_file, PATHINFO_EXTENSION);

            if ($doc_file_type != "docx" && $doc_file_type != "ppt" && $doc_file_type != "pdf" && $doc_file_type != "xls") {
                echo "<script>alert('Docx, PPT, PDF and XLS files are allowed!')</script>";
                $movfile = 0;
            } else {
                $movfile = move_uploaded_file($temp_doc, $target_doc_file);
                $movfile = 1;
            }

            //Check if image is an actual image or fake image
            $check_img = getimagesize($temp_image);

            if ($check_img == false) {
                echo "<script>alert('File is not an image')</script>";

                $upload_ok = 0;
            } else {
                $upload_ok = 1;

                //Check if file already exists
                if (file_exists($target_file)) {
                    echo "<script>alert('File is already uploaded!')</script>";

                    $upload_ok = 0;
                } else {
                    //Check file size
                    if ($file_size > 5000000) {
                        echo "<script>alert('Please enter a file size between 5mb!')</script>";

                        $upload_ok = 0;
                    } else {
                        //Allow certain file formats
                        if ($img_file_type != "jpg" && $img_file_type != "png" && $img_file_type != "jpeg" && $img_file_type != "gif") {
                            echo "<script>alert('JPG, PNG, JPEG and GIF files are allowed!')</script>";

                            $upload_ok = 0;
                        } else {
                            //Check if $upload_ok is set to 0 by an error
                            if ($upload_ok === 0) {
                                echo "<script>alert('File has not been uploaded!')</script>";
                            } else {
                                $move_img = move_uploaded_file($temp_image, $target_file);
                                $move_img = 1;
                            }

                        }
                    }
                }
            }

            if ($movfile == 1 && $move_img == 1) {
                $sql = "INSERT INTO `user_info`(`name`, `fname`, `mname`, `mobile`, `email`, `address`,`gender`,`religion`, `image_path`,`docfile`, `agree`)
                                        VALUES(:name,:fname,:mname, :mobile, :email, :address, :gender, :religion, :image,:docfile, :agree)";
                $query = $this->conn->prepare($sql);
                $query->bindParam('name', $name, PDO::PARAM_STR);
                $query->bindParam('fname', $fname, PDO::PARAM_STR);
                $query->bindParam('mname', $mname, PDO::PARAM_STR);
                $query->bindParam('mobile', $mobile, PDO::PARAM_STR);
                $query->bindParam('email', $email, PDO::PARAM_STR);
                $query->bindParam('address', $address, PDO::PARAM_STR);
                $query->bindParam('gender', $gender, PDO::PARAM_STR);
                $query->bindParam('religion', $religion, PDO::PARAM_STR);
                $query->bindParam('image', $target_file, PDO::PARAM_STR);
                $query->bindParam('docfile', $target_doc_file, PDO::PARAM_STR);
                $query->bindParam('agree', $agree, PDO::PARAM_STR);
                $query->execute();
                echo "<script>alert('Record Added with image and DOC file')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }

        }
    }

    public function fetch()
    {
        $data = null;

        $query = "SELECT * FROM user_info";
        return $data = $this->conn->query($query);
    }

    public function delete($id, $filepath_img, $filepath_doc)
    {
        $query = $this->conn->prepare("DELETE FROM user_info WHERE id = :delete_id");
        $query->bindParam("delete_id", $id, PDO::PARAM_STR);
        $query->execute();
        unlink($filepath_img);
        unlink($filepath_doc);

        echo "<script>alert('Record Deleted')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }

    public function edit($id)
    {
        $data = $this->conn->prepare("SELECT * FROM user_info WHERE id = :id");
        $data->execute(array(':id' => $id));

        foreach ($data as $value) {
            return $value;
        }

    }

    public function update($name, $fname, $mname, $mobile, $email, $address, $gender, $religion, $id)
    {
        $sql = "UPDATE user_info SET name = :name, fname = :fname, mname = :mname, mobile= :mobile, email=:email, address=:address, gender=:gender, religion=:religion  WHERE id = :id";
        $query = $this->conn->prepare($sql);
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->bindParam("fname", $fname, PDO::PARAM_STR);
        $query->bindParam("mname", $mname, PDO::PARAM_STR);
        $query->bindParam("mobile", $mobile, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("address", $address, PDO::PARAM_STR);
        $query->bindParam("gender", $gender, PDO::PARAM_STR);
        $query->bindParam("religion", $religion, PDO::PARAM_STR);
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Record Has been updated')</script>";
        echo "<script>window.open('index.php','_self')</script>";

    }
}
