<?php
require_once("inc/connection.php");

$newbalance = 0;
$amount = 0;

if (isset($_POST['submit'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $get_customer_q = "SELECT * from customers where id=$from";
    $stmt = $connection->prepare($get_customer_q);
    $stmt->execute();
    $sender = $stmt->fetch();

    $get_customer_q = "SELECT * from customers where id=$to";
    $stmt = $connection->prepare($get_customer_q);
    $stmt->execute();
    $receiver = $stmt->fetch();

    //Conditions
    //For negative value
    if (($amount) < 0) {
        echo "<script> alert('Negative value cannot be transferred!');
                window.location='transfer.php?id=$from';
                </script>";
    }

    //Insufficient balance
    else if ($amount >= $sender['balance']) {
        echo "<script> alert('Sorry! you have insufficient balance!');
                window.location='transfer.php?id=$from';
                </script>";
    }

    //For 0 (zero) value
    else if ($amount == 0) {
        echo "<script> alert('Zero value cannot be transferred!');
                window.location='transfer.php?id=$from';
                </script>";
    } else {

        $sender_id = $sender['id'];
        $newbalance = $sender['balance'] - $amount;
        $update_balance = "UPDATE customers set balance=? where id=?";
        $stmt = $connection->prepare($update_balance);
        $stmt->execute([
            $newbalance,
            $sender_id,
        ]);

        $receiver_id = $receiver['id'];
        $newbalance = $receiver['balance'] + $amount;
        $update_balance = "UPDATE customers set balance=? where id=?";
        $stmt = $connection->prepare($update_balance);
        $stmt->execute([
            $newbalance,
            $receiver_id,
        ]);

        $sender_name = $sender['name'];
        $receiver_name = $receiver['name'];
        $trans_num = uniqid();
        $insert_transaction = "INSERT INTO transactions (amount, sender, receiver) values (?,?,?)";
        $stmt = $connection->prepare($insert_transaction);
        $stmt->execute([
            $amount,
            $sender_name,
            $receiver_name
        ]);

        if ($stmt) {
            echo "<script> alert('Transaction Successfully !');
                    window.location='transactions.php';
                </script>";
        }
    }
}
