<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/UI-home.css">

</head>

<body>
    <div class="head-page">
        <div class="row">
            <div class="col-10">
                <h2 id="title">Home</h2>
            </div>
            <div class="col-2">
                <div class="setting">
                    <a href="">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-2 option-setting"></div>

        <div class="col-10">
            Wellcome !!!
            <div class="row">
                <div class="option col-3 op1 ">
                    <div class="display-op">
                        <h5 class="title-op">Staff</h5>
                        <br>
                    </div>
                </div>
                <div class="option col-3 op2 ">
                    <div class="display-op">
                        <h5 class="title-op">Role</h5>
                        <br>
                    </div>
                </div>
                <div class="option col-3 op3 ">
                    <div class="display-op">
                        <h5 class="title-op">Employee manager</h5>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                            </svg></a>
                        <br>
                    </div>
                </div>
                <div class="option col-3 op4 ">
                    <div class="display-op">
                        <h5 class="title-op">Create new staff</h5>
                        <br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">1</div>
                <div class="col-6">1</div>
            </div>
        </div>
    </div>
</body>

</html> -->

<?php
ob_start();
session_start();
if ($_SESSION['type'] == "admin") {
    echo ("admin");
} else {
    echo ("user");
}
?>

<?php

include_once "d06_batch.php";

use Model\EmployeeDao;
use Model\Employee;

$b = new Employee;
$ds = EmployeeDao::get();
if (isset($_SESSION['type'])) {

    $type = $_SESSION['type'];
    $check = Model\EmployeeDao::getType($type);
    if ($check == false) {
        die("Invalid ID");
    }
} else {
    die("Missing ");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2>LIST </h2>
            </div>
            <div class="col-4"><?php echo $check['cusName']; ?><a href="d06_login.php"> Logout</a></div>
        </div>
        <hr>
        <?php
        if ($check['type'] == "admin") { ?>
            <a href="d06_batch_create.php">Create New Batch</a>
            <br></br>
        <?php }
        ?>
        <label for="">Enter name: </label>
        <input type="text" name="nSearch" id="nSearch">
        <input type="button" value="Search" name="btnOK" id="btnOK" class="btn btn-success" onclick="search()">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>Fee</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="content" id="content">
                <?php
                foreach ($ds as $row) { ?>
                    <tr>
                        <td><?php echo  $row['b_id'] ?></td>
                        <td><?php echo  $row['b_name'] ?></td>
                        <td><?php echo  $row['dateStart'] ?></td>
                        <td><?php echo  $row['fee'] ?></td>
                        <td>
                            <?php
                            if ($check['type'] == "admin") { ?>
                                <a href="../d06/d06_batch_detail.php?id=<?php echo $row['b_id'] ?>">Detail </a>
                                <a href="../d06/d06_batch_update.php?id=<?php echo $row['b_id'] ?>">Update </a>
                                <a href="../d06/d06_batch_delete.php?id=<?php echo $row['b_id'] ?>" onclick="javascript:return confirm('Are u sure')">Delete</a>
                            <?php } else { ?>
                                <a href="../d06/d06_batch_detail.php?id=<?php echo $row['b_id'] ?>">Detail </a>
                            <?php }
                            ?>
                        </td </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        function search() {
            let v = $("#nSearch").val();

            $.ajax({
                type: "GET",
                url: "../d07/d07_batch_view_res.php",
                data: {
                    name: v
                },
                dataType: "json",
                success: function(response) {

                    let content = ``;
                    response.forEach(element => {
                        content += `<tr>`;
                        content += `<td>${element.b_id}</td>`;
                        content += `<td>${element.b_name}</td>`;
                        content += `<td>${element.dateStart}</td>`;
                        content += `<td>${element.fee}</td>`;
                        content += `<td><a href="../d06/d06_batch_detail.php?id=${element.b_id}">Detail </a>
                                <a href="../d06/d06_batch_update.php?id=${element.b_id}">Update </a>
                                <a href="../d06/d06_batch_delete.php?id=${element.b_id}" onclick="javascript:return confirm('Are u sure')">Delete</a></td>`;
                    });
                    $("#content").html(content);
                }
            });
        }
    </script>
</body>

</html>