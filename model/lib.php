<?php

function getConnect()
{
    $host = "localhost:3306";
    $username = "root";
    $password = "";
    $db = "management";

    //1. tao ket noi den CSDL
    $cn = mysqli_connect($host, $username, $password, $db);

    if ($cn->connect_error) {
        die("<h3> Error: " . $cn->connect_error . " </h3>");
        exit;
    }
    return $cn;
}
