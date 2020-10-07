<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>

<?php
include 'func.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){

        $data['sname'] = $_POST['sname'];
        $data['fname'] = $_POST['fname'];
        $data['mname'] = $_POST['mname'];
        $data['address'] = $_POST['address'];
        $data['mobile'] = $_POST['mobile'];

       // $data = $_POST;
        $table_name = "test";
        $obj = new Func();
        $obj->insert($data, $table_name);

    }

}

?>

    <form action="" method="post">
        <input type="text" name="sname">
        <input type="text" name="fname">
        <input type="text" name="mname">
        <input type="text" name="address">
        <input type="text" name="mobile">
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>