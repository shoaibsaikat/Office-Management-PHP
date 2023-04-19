<?php

// create
function registerUser($username, $firstname, $lastname, $email, $password) {
    global $connection;
    $query = "INSERT INTO user (username, first_name, last_name, email, password) ";
    $query .= "VALUES ('{$username}', '{$firstname}', '{$lastname}', '{$email}', '{$password}')";
    if (!mysqli_query($connection, $query)) {
        die("INSERT ERROR " . mysqli_error($connection));
    }
}

function addUser($firstname, $lastname, $username, $image, $role, $email, $password) {
    global $connection;
    $query = "INSERT INTO users (user_firstname, user_lastname, user_username, user_image, user_role, user_email, user_password) ";
    $query .= "VALUES ('{$firstname}', '{$lastname}', '{$username}', '{$image}', '{$role}', '{$email}', '{$password}')";
    if (!mysqli_query($connection, $query)) {
        die("INSERT ERROR " . mysqli_error($connection));
    }
}

// read
function getAllUsers() {
    global $connection;
    $query = "SELECT * FROM users";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getAllSubscribers() {
    global $connection;
    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getUserById($id) {
    global $connection;
    $query = "SELECT * FROM users WHERE user_id = {$id}";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getUserByUsername($name) {
    global $connection;
    $query = "SELECT * FROM user WHERE username = '{$name}'";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function isDuplicateUsername($name) {
    global $connection;
    $query = "SELECT * FROM users WHERE user_username = '{$name}'";

    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) == 0)
            return false;
        return true;
    }
    return false;
}

// update
function makeAdminUser($id) {
    global $connection;
    $query = "UPDATE users SET ";
    $query .= "user_role = 'admin' ";
    $query .= "WHERE user_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

function makeSubscriberUser($id) {
    global $connection;
    $query = "UPDATE users SET ";
    $query .= "user_role = 'subscriber' ";
    $query .= "WHERE user_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

function updateUserWithoutPassword($id, $firstname, $lastname, $username, $image, $role, $email) {
    global $connection;
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$firstname}', ";
    $query .= "user_lastname = '{$lastname}', ";
    $query .= "user_username = '{$username}', ";
    $query .= "user_image = '{$image}', ";
    $query .= "user_role = '{$role}', ";
    $query .= "user_email = '{$email}' ";
    $query .= "WHERE user_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

function updateUser($id, $firstname, $lastname, $username, $image, $role, $email, $password) {
    global $connection;
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$firstname}', ";
    $query .= "user_lastname = '{$lastname}', ";
    $query .= "user_username = '{$username}', ";
    $query .= "user_image = '{$image}', ";
    $query .= "user_role = '{$role}', ";
    $query .= "user_email = '{$email}', ";
    $query .= "user_password = '{$password}' ";
    $query .= "WHERE user_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

// delete
function deleteUser($id) {
    global $connection;
    $query = "DELETE from users WHERE user_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("DELETE ERROR " . mysqli_error($connection));
    }
}

?>
