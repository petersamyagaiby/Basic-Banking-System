<?php
require_once("inc/navbar.php");
require_once("inc/connection.php");

$get_transactions_q = "SELECT * FROM transactions";
$stmt = $connection->prepare($get_transactions_q);
$stmt->execute();
$transactions = $stmt->fetchAll();
?>

<section class="container my-5">
    <div class="my-header text-center pb-5">
        <h1>All Transactions</h1>
    </div>
    <div class="d-flex justify-content-center">
        <table class="text-center mb-5">
            <tr>
                <th style="width: 33%;" class="text-center">Money Transferred</th>
                <th style="width: 33%;" class="text-center">Sender</th>
                <th style="width: 33%;" class="text-center">Receiver</th>
            </tr>
            <?php foreach ($transactions as $transaction) { ?>
                <tr>
                    <td style="width: 33%;" class="text-center"><?= $transaction['amount'] ?></td>
                    <td style="width: 33%;" class="text-center"><?= $transaction['sender'] ?></td>
                    <td style="width: 33%;" class="text-center"><?= $transaction['receiver'] ?></td>
                </tr>
            <?php } ?>

        </table>
    </div>
</section>

<?php
require_once("inc/footer.php");
?>