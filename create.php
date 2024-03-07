<?php
require_once("inc/navbar.php");
require_once("inc/connection.php");


?>

<section class="container create-card my-5">
    <div class="p-4">
        <form class="pb-3" method="POST" action="handleCreate.php" autocomplete="off">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="uname" />
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="Email" name="uemail" />
            </div>
            <div class="mb-3">
                <label class="form-label">Balance</label>
                <input type="number" step="any" class="form-control" placeholder="Balacne" name="ubalance" />
            </div>
            <button type="submit" class="btn create-btn bg-success text-white" name="create">Create</button>
        </form>
    </div>
</section>

<?php
require_once("inc/footer.php");
?>