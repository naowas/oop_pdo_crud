<?php
include 'inc/header.php';
require 'class/functions.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {

        $data['name'] = $_POST['name'];
        $data['fname'] = $_POST['fname'];
        $data['mname'] = $_POST['mname'];
        $data['mobile'] = $_POST['mobile'];
        $data['email'] = $_POST['email'];
        $data['address'] = $_POST['address'];
        $data['gender'] = $_POST['gender'];
        $data['religion'] = $_POST['religion'];
        $data['agree'] = $_POST['agree'];

        //File Part

        $timestamp = time();
        $docfile = $_FILES["docfile"]["name"];
        $temp_doc = $_FILES["docfile"]["tmp_name"];
        $file_size = $_FILES["docfile"]["size"];
        $target_doc_dir = "uploads/";
        $data['docfile'] = $target_doc_file = strtolower($target_doc_dir .$timestamp. basename($docfile));
        $doc_file_type = pathinfo($target_doc_file, PATHINFO_EXTENSION);

        if ($doc_file_type != "docx" && $doc_file_type != "ppt" && $doc_file_type != "pdf" && $doc_file_type != "xls") {
            echo "<script>alert('Docx, PPT, PDF and XLS files are allowed!')</script>";
        } else {
            $movfile = move_uploaded_file($temp_doc, $target_doc_file);
        }


        //image Part

        $imgfile = $_FILES["image"]["name"];
        $temp_img = $_FILES["image"]["tmp_name"];
        $file_size = $_FILES["image"]["size"];
        $target_img_dir = "uploads/";
        $data['image_path'] = $target_img_file = strtolower($target_img_dir .$timestamp. basename($imgfile));
        $img_file_type = pathinfo($target_img_file, PATHINFO_EXTENSION);

        if ($img_file_type != "jpg" && $img_file_type != "png" && $img_file_type != "jpeg" && $img_file_type != "gif") {
              echo "<script>alert('png, jpg, gif and JPEG files are allowed!')</script>";
        } else {
            $movfile = move_uploaded_file($temp_img, $target_img_file);
        }


        $table_name = "user_info";
        $obj = new Functions();
        $obj->insert($data, $table_name);

    }

}

?>
<div class="container">
    <div class="container-fluid">
        <?php
include 'inc/nav.php';
?>
        <form action="add.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name">
            </div>
            <div class="form-group">
                <label for="fname">Father Name</label>
                <input type="text" name="fname" class="form-control" id="name" placeholder="Father's Name">
            </div>
            <div class="form-group">
                <label for="mname">Mother Name</label>
                <input type="text" class="form-control" id="mname" name="mname" placeholder="Mother's Name">
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="0170000000">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Name">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="" cols="30" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio">
                        <input type="radio" style="margin-left: 20px;" class="form-check-input" id="male" name="gender"
                            value="Male">Male
                    </label>
                </div>

                <div class="form-check-inline">
                    <label class="form-check-label" for="radio">
                        <input type="radio" class="form-check-input" id="female" name="gender" value="Female">Female
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="religion">Religion</label>
                <select class="custom-select" name="religion">
                    <option selected>Select Religion</option>
                    <option value="Islam">Islam</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Christian">Christian</option>
                </select>
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="image">
                    <label class="custom-file-label" for="customFile">Image</label>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="docfile" id="docfile">
                    <label class="custom-file-label" for="customFile">Doc File</label>
                </div>
            </div>

            <div class="form-group">
                <label for="agree">Do you agree?</label>
                <div class="form-check">
                    <input class="form-check-input" name="agree" type="checkbox" value="yes" id="agree_yes">
                    <label class="form-check-label" for="agree">Yes</label>
                </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</div>

<?php
include "inc/footer.php";
?>