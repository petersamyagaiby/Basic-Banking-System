<?php
require_once("inc/navbar.php");
require_once("inc/connection.php");


$id = $_GET['id'];
$get_customer_q = "SELECT * FROM  customers where id=$id";
$stmt = $connection->prepare($get_customer_q);
$stmt->execute();
$customer = $stmt->fetch();

$sid = $_GET['id'];
$get_customers_q = "SELECT * FROM customers where id!=$sid";
$stmt = $connection->prepare($get_customers_q);
$stmt->execute();
$customers = $stmt->fetchAll();

?>

<section class="container">
    <h2 class="text-center pt-4">Customer Details</h2>
    <form method="POST" action="handleTransfer.php"><br>
        <div>
            <table class="table table-striped table-hover">
                <tr class="table-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                </tr>
                <tr>
                    <td class="py-2"><?= $customer['id'] ?></td>
                    <td class="py-2"><?= $customer['name'] ?></td>
                    <td class="py-2"><?= $customer['email'] ?></td>
                    <td class="py-2"><?= $customer['balance'] ?></td>
                </tr>
            </table>
        </div>

        <h2 class="text-center pt-4 pb-2">Transer Money Here !</h2>
        <label><strong>Transfer To:</strong></label>
        <input type="hidden" name="from" value="<?= $_GET['id'] ?>">
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>

            <?php
            foreach ($customers as $customer) {
            ?>
                <option class="table" value="<?= $customer['id']; ?>">

                    <?= $customer['name']; ?> (Balance:
                    <?= $customer['balance']; ?> )

                </option>
            <?php } ?>

        </select>

        <div class="mt-4">
            <label><strong>Amount:</strong></label>
            <input type="number" class="form-control" step="any" name="amount" required>
            <div class="text-center">
                <button class="btn btn-primary text-white mt-5" name="submit" type="submit">Transfer Money</button>
            </div>
        </div>
    </form>