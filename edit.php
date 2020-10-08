<?php
include 'inc/header.php';
require 'class/functions.class.php';
// $model = new Functions();
// $model->insert();

?>
<div class="container">
    <div class="container-fluid">
               <?php
include 'inc/nav.php';
?>
        <form action="" method="POST" enctype="multipart/form-data">

<?php

$model = new Functions;
$id = $_REQUEST['id'];
$table_name= "user_info";
$row = $model->viewbyid($id,$table_name);
$image_old = $row['image_path'];
$docfile_old = $row['docfile'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $data['name'] = $_POST['name'];
        $data['fname'] = $_POST['fname'];
        $data['mname'] = $_POST['mname'];
        $data['mobile'] = $_POST['mobile'];
        $data['email'] = $_POST['email'];
        $data['address'] = $_POST['address'];
        $data['gender'] = $_POST['gender'];
        $data['religion'] = $_POST['religion'];
        
      
        $uniqueid = uniqid();

        $image = $_FILES["image"]["name"];
        $temp_image = $_FILES["image"]["tmp_name"];
        $file_size = $_FILES["image"]["size"];
        $target_dir = "uploads/";
       $data['image_path'] = $target_file = strtolower($target_dir .$uniqueid. basename($image));
        $img_file_type = pathinfo($target_file, PATHINFO_EXTENSION);

        if ($img_file_type != "jpg" && $img_file_type != "png" && $img_file_type != "jpeg" && $img_file_type != "gif") {
            echo "<script>alert('jpg, png, jpeg and gif files are allowed!')</script>";

        } else {
            $move_img = move_uploaded_file($temp_image, $target_file);
        }

                /// File Part
        $docfile = $_FILES["docfile"]["name"];
        $temp_doc = $_FILES["docfile"]["tmp_name"];
        $target_doc_dir = "uploads/";
        $data['docfile'] = $target_doc_file = strtolower($target_doc_dir .$uniqueid. basename($docfile));
        $doc_file_type = pathinfo($target_doc_file, PATHINFO_EXTENSION);

        if ($doc_file_type != "docx" && $doc_file_type != "ppt" && $doc_file_type != "pdf" && $doc_file_type != "xls") {
            echo "<script>alert('Docx, PPT, PDF and XLS files are allowed!')</script>";
        } else {
            $movfile = move_uploaded_file($temp_doc, $target_doc_file);
        }


        $table_name = "user_info";

        $query = new Functions();
        $query->update($data, $table_name, $image_old, $docfile_old, $id);
    }
}
?>

            <div class="form-group">

                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $row['name']; ?>">
            </div>
            <div class="form-group">
                <label for="fname">Father Name</label>
                <input type="text" name="fname" class="form-control" id="name" value="<?php echo $row['fname']; ?>">
            </div>
            <div class="form-group">
                <label for="mname">Mother Name</label>
                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $row['mname']; ?>">
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $row['mobile']; ?>">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="" cols="30" rows="2"><?php echo $row['address']; ?></textarea>
            </div>


            <?php

if ($row['gender'] == "Male") {;
    ?>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="radio">
                            <input type="radio" style="margin-left: 20px;" class="form-check-input" id="male" name="gender" value="Male" checked>Male
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label" for="radio">
                            <input type="radio" class="form-check-input" id="female" name="gender" value="Female">Female
                        </label>
                    </div>
                </div>
            <?php
}
?>


            <?php
if ($row['gender'] == "Female") {;
    ?>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="radio">
                            <input type="radio" style="margin-left: 20px;" class="form-check-input" id="male" name="gender" value="Male">Male
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label" for="radio">
                            <input type="radio" class="form-check-input" id="female" name="gender" value="Female" checked>Female
                        </label>
                    </div>
                </div>
            <?php
}
?>


            <?php
if ($row['religion'] === "Islam") {;
    ?>
                <div class="form-group">
                    <label for="religion">Religion</label>
                    <select class="custom-select" name="religion">
                        <option selected>Islam</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Christian">Christian</option>
                    </select>
                </div>
            <?php
}
?>

            <?php
if ($row['religion'] === "Hindu") {;
    ?>
                <div class="form-group">
                    <label for="religion">Religion</label>
                    <select class="custom-select" name="religion">
                        <option value="Islam">Islam</option>
                        <option value="Hindu" selected>Hindu</option>
                        <option value="Christian">Christian</option>
                    </select>
                </div>
            <?php
}
?>

            <?php
if ($row['religion'] === "Christian") {;
    ?>
                <div class="form-group">
                    <label for="religion">Religion</label>
                    <select class="custom-select" name="religion">
                        <option value="Islam">Islam</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Christian" selected>Christian</option>
                    </select>
                </div>
            <?php
}
?>


            <div class="form-group">
                <img style="width: 50px; height:50px;" src="<?php echo $row['image_path']; ?>" alt="">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="image">
                    <label class="custom-file-label" for="customFile">Image</label>
                </div>
            </div>

            <div class="form-group">
                <label for="filename">Uploaded File -->> <?php echo $row['docfile']; ?></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="docfile" id="docfile">
                    <label class="custom-file-label" for="customFile">Doc File</label>
                </div>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
</div>

<?php
include "inc/footer.php";
?>