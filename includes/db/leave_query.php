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
function getAllLeaveByUserInCurrentYear($id, $page) {
    global $connection;
    $offset = ($page - 1) * ENV_PAGE_LIMIT;
    $limit = ENV_PAGE_LIMIT;
    $query = "SELECT * FROM `leave` WHERE user_id = {$id} AND YEAR(start_date) = YEAR(CURDATE()) ORDER BY start_date DESC ";
    $query .= "LIMIT {$limit} OFFSET {$offset}";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getAllLeaveCountByUserInCurrentYear($id) {
    global $connection;
    $query = "SELECT * FROM `leave` WHERE user_id = {$id} AND YEAR(start_date) = YEAR(CURDATE()) ORDER BY start_date DESC";
    if ($result = mysqli_query($connection, $query))
        return mysqli_num_rows($result);
    return 0;
}

// if approved is NULL then it's pending, if it's 0 then it's disapproved
function getAllPendingLeaveByApproverInCurrentYear($id, $page) {
    global $connection;
    $offset = ($page - 1) * ENV_PAGE_LIMIT;
    $limit = ENV_PAGE_LIMIT;
    $query = "SELECT leave.id, leave.start_date, leave.day_count, leave.comment, user.first_name, user.last_name ";
    $query .= "FROM `leave` INNER JOIN `user` ON user.id = leave.user_id ";
    $query .= "WHERE approver_id = {$id} AND approved IS NULL AND YEAR(start_date) = YEAR(CURDATE()) ";
    $query .= "ORDER BY start_date ";
    $query .= "LIMIT {$limit} OFFSET {$offset}";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getAllPendingLeaveCountByApproverInCurrentYear($id) {
    global $connection;
    $query = "SELECT leave.id, leave.start_date, leave.day_count, leave.comment, user.first_name, user.last_name ";
    $query .= "FROM `leave` INNER JOIN `user` ON user.id = leave.user_id ";
    $query .= "WHERE approver_id = {$id} AND approved IS NULL AND YEAR(start_date) = YEAR(CURDATE()) ";
    $query .= "ORDER BY start_date";
    if ($result = mysqli_query($connection, $query))
    return mysqli_num_rows($result);
    return 0;
}

// update
function leaveApprove($id) {
    global $connection;
    $now = date("Y-m-d");
    $query = "UPDATE `leave` SET ";
    $query .= "approved = '1', ";
    $query .= "approve_date = {$now} ";
    $query .= "WHERE id = {$id}";
    if (!mysqli_query($connection, $query))
        die("UPDATE ERROR " . mysqli_error($connection));
}

function leaveDecline($id) {
    global $connection;
    $now = date("Y-m-d");
    $query = "UPDATE `leave` SET ";
    $query .= "approved = '0' ";
    $query .= "WHERE id = {$id}";
    if (!mysqli_query($connection, $query))
        die("UPDATE ERROR " . mysqli_error($connection));
}
?>