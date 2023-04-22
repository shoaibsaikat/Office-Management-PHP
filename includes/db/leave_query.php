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

// read
function getAllLeaveByYear($id) {
    global $connection;
    $query = "SELECT * FROM `leave` WHERE id = {$id} AND YEAR(start_date) = YEAR(CURDATE())";
    if (mysqli_query($connection, $query))
        return false;
    return true;
}

// update
function approveLeave($id) {
    global $connection;
    $now = date("Y-m-d");
    $query = "UPDATE `leave` SET ";
    $query .= "approved = '1', ";
    $query .= "approve_date = {$now} ";
    $query .= "WHERE id = {$id}";
    if (!mysqli_query($connection, $query))
        die("UPDATE ERROR " . mysqli_error($connection));
}
?>