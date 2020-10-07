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
        <form>

            <?php
            $model = new Functions;
            $id = $_REQUEST['id'];
            $table_name = "user_info";
            $row = $model->viewbyid($id,$table_name);
            ?>

            <div class="form-group">

                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $row['name']; ?> " readonly>
            </div>
            <div class="form-group">
                <label for="fname">Father Name</label>
                <input type="text" name="fname" class="form-control" id="name" value="<?php echo $row['fname']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="mname">Mother Name</label>
                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $row['mname']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $row['mobile']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea readonly class="form-control" name="address" id="" cols="30" rows="2"><?php echo $row['address']; ?></textarea>
            </div>


            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $row['gender']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="gender">Religion</label>
                <input type="text" class="form-control" name="religion" id="religion" value="<?php echo $row['religion']; ?>" readonly>
            </div>


            <div class="form-group">
                <img style="width: 100px; height:100px;" src="<?php echo $row['image_path']; ?>" alt="">
            </div>

            <div class="form-group">
                <a href="<?php echo $row['docfile'];?>" download> Download Document File</a>
            </div>
        </form>
    </div>
</div>
</div>

<?php
include "inc/footer.php";
?>