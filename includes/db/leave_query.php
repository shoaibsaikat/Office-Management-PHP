<?php
// create
function createLeave($user, $approver, $start, $days, $reason) {
    global $connection;
    $now = date("Y-m-d");
    $query = "INSERT INTO `leave` (user_id, approver_id, start_date, day_count, comment, creation_date) ";
    $query .= "VALUES ('{$user}', '{$approver}', '{$start}', {$days}, '{$reason}', '{$now}')";
    if (!mysqli_query($connection, $query)) {
        die("INSERT ERROR " . mysqli_error($connection));
    }
}
?>