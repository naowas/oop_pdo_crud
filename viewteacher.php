<?php
include 'inc/header.php';
require 'class/functions.class.php';
$model = new Functions();
$table_name = "teacher_info";
$rows = $model->fetch($table_name);

?>

<body>

    <div class="container">
        <div class="container-fluid">

<?php
include 'inc/nav.php';
?>
            <div class="row">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
if (!empty($rows)) {
    foreach ($rows as $key => $row) {
        ?>
                                <tr>
                                    <th scope="row"><?php echo ++$key; ?></th>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><img style="height: 50px; width:50px;" src="<?php echo $row['image_path']; ?>" alt="user image"></td>
                                    <td>
                                        <a href="view.php?id=<?php echo $row['id']; ?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                        <a href="#deleteuser<?php echo $row['id']; ?>" class="delete" title="Delete" data-toggle="modal" data-target="#deleteuser<?php echo $row['id']; ?>"><i class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>
                        <?php
}
}
?>
                    </tbody>
                </table>




                <?php

$model = new Functions();
$rows = $model->fetch($table_name);
if (!empty($rows)) {
    foreach ($rows as $row) {

        if (isset($_POST['delete'])) {

            $filepath_img = $row['image_path'];
            $filepath_doc = $row['docfile'];
            $id = $_POST['delete_id'];
            $table_name = "teacher_info";
            $del = $model->delete($id, $table_name, $filepath_img, $filepath_doc);
        }
        ?>
                        <!-- modal small -->
                        <div class="modal fade" id="deleteuser<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Information</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                <p>Are you sure you want to delete these Records?</p>
                                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                <input type="submit" name="delete" class="btn btn-danger" value="Delete">
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                <?php
}
}
?>
                <!-- end modal small -->

            </div>
        </div>
    </div>

    <?php
include 'inc/footer.php'
?>