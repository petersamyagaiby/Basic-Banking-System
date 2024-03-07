<?php
require_once("inc/navbar.php");
require_once("inc/connection.php");

$customer_id = $_GET['id'];
$get_customer_q = "SELECT * from customers where id=$customer_id";
$stmt = $connection->prepare($get_customer_q);
$stmt->execute();
$customer = $stmt->fetch();

?>

<section class="container my-5">
    <div class="my-header text-center pb-5">
        <h1>All Customers</h1>
    </div>
    <div class="d-flex justify-content-center">
        <table class="text-center mb-5">
            <tr>
                <th style="width: 10%;">ID</th>
                <th style="width: 20%;">Name</th>
                <th style="width: 30%;">Email</th>
                <th style="width: 15%;">Balance</th>
                <th style="width: 25%;">Transfer Money</th>
            </tr>
            <tr>
                <td><?= $customer['id'] ?></td>
                <td><?= $customer['name'] ?></td>
                <td><?= $customer['email'] ?></td>
                <td><?= $customer['balance'] ?></td>
                <td><a href="transfer.php?id=<?= $customer['id'] ?> " class="btn btn-primary text-white">Transfer Money</a></td>
            </tr>

        </table>
    </div>
</section>

<?php
require_once("inc/footer.php");
?>