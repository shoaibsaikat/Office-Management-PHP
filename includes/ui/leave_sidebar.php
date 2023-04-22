<div class="col-md-4">
<?php if (isset($_SESSION["id"])) {  ?>
    <?php if (!isset($_SESSION["manager"])) {?>
        <h4 class="secondary-color rounded-2">&nbsp;&nbsp;Your manager is not set.</h4>
    <?php } else {?>
    <div>
        <h4>Apply for leave</h4>
        <form action="includes/action/leave_create.php" method="post">
            <div class="mb-3">
                <input type="date" class="form-control" name="date" placeholder="Start date">
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" name="days" placeholder="How may days?">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="reason" placeholder="Enter short reason" maxlength="45">
            </div>
            <button type="submit" class="btn primary-button-color" name="apply_leave">Apply</button>
        </form>
    </div>
<?php
        }
    }
?>
</div>
