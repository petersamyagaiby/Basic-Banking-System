<?php
require_once("inc/connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['uname'];
    $email = $_POST['uemail'];
    $balance = $_POST['ubalance'];

    //insert into DB
    $insert_customer = "insert into customers (name, email, balance) values (?,?,?)";
    $stmt = $connection->prepare($insert_customer);
    $stmt->execute([
        $name,
        $email,
        $balance
    ]);
    header("location: customers.php");
} else {
    header("location: create.php");
}
