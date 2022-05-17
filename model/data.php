<?php

namespace Model;

include_once "lib.php";

class Employee
{
    public $eID, $eName, $email, $pwd, $role, $salary, $phone;

    public function __construct($eID = null, $eName = "", $email = "", $pwd = "", $role = "", $salary = 1000, $phone = "")
    {
        $this->e_id = $eID;
        $this->e_name = $eName;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->role = $role;
        $this->salary = $salary;
        $this->phone = $phone;
    }
}
class Account
{
}
class EmployeeDao
{
    public static function get()
    {
        $cn = getConnect();
        $sql = "SELECT * from `tbemployee`";
        $rs = $cn->query($sql);
        $ds = null;
        if ($rs) {
            if ($rs->num_rows > 0) {
                $ds = $rs->fetch_all(MYSQLI_ASSOC);
            }
        } else {
            echo "ERROR" . $cn->error;
        }
        $cn->close();

        return $ds;
    }

    public static function login($acc)
    {
        $cn = getConnect();
        $sql = "SELECT * from `tbemployee` where `email` = '$acc'";
        $rs = $cn->query($sql);
        $ds = null;
        if ($rs) {
            if ($rs->num_rows > 0) {
                $ds = $rs->fetch_assoc();
               
            }
        } else {
            echo "ERROR" . $cn->error;
        }
        $cn->close();

        return $ds;
    }
    public static function getType($acc)
    {
        $cn = getConnect();
        $sql = "SELECT * from `tbemployee` where `email` = '$acc'";
        $rs = $cn->query($sql);
        $ds = null;
        if ($rs) {
            if ($rs->num_rows > 0) {
                $ds = $rs->fetch_assoc();
               
            }
        } else {
            echo "ERROR" . $cn->error;
        }
        $cn->close();

        return $ds;
    }
}
