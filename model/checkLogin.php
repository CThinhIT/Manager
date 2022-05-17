<?php
ob_start();
session_start();
include_once "data.php";
if (isset($_POST["btn-log"])) {
    $acc = $_POST['userName'];
    $pwd = $_POST['pwd'];
    $row = Model\EmployeeDao::login($acc);
    if ($row['password'] == $pwd) {
        if ($row['role'] == 1) {
            $_SESSION['role'] = 1;
        } elseif ($row['role'] == 2) {
            $_SESSION['role'] = 2;
        }
        header("location:../ui/screenHome.php");
    } else {
        die("Tài khoản hoặc mật khẩu không đúng");
    }
}
