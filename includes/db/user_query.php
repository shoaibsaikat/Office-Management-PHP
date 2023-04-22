<?php
// create
function registerUser($username, $firstname, $lastname, $email, $password) {
    global $connection;
    if (duplicateUsername($username))
        return;
    $now = date("Y-m-d");
    $query = "INSERT INTO user (username, first_name, last_name, email, password, date_joined) ";
    $query .= "VALUES ('{$username}', '{$firstname}', '{$lastname}', '{$email}', '{$password}', '{$now}')";
    if (!mysqli_query($connection, $query))
        die("INSERT ERROR " . mysqli_error($connection));
}

// read
function validUser($id, $token) {
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$id} AND token = $token";
    if (mysqli_query($connection, $query))
        return false;
    return true;
}

function getAllUsers($id, $token) {
    if (!validUser($id, $token))
        return null;
    global $connection;
    $query = "SELECT * FROM user";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getUserById($id) {
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$id}";
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

function duplicateUsername($name) {
    global $connection;
    $query = "SELECT * FROM user WHERE username = '{$name}'";
    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) == 0)
            return false;
        return true;
    }
    return false;
}

// update
function setSupervisor($user_id, $supervisor_id) {
    if ($user_id != $supervisor_id) {
        global $connection;
        $query = "UPDATE user SET ";
        $query .= "supervisor_id = '{$supervisor_id}' ";
        $query .= "WHERE id = {$user_id}";
        if (!mysqli_query($connection, $query)) {
            die("UPDATE ERROR " . mysqli_error($connection));
            return false;
        }
        return true;
    }
    return false;
}

function login($id) {
    global $connection;
    $now = date("Y-m-d");
    $query = "UPDATE user SET ";
    $query .= "last_login = '{$now}' ";
    $query .= "WHERE id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
        return false;
    }
    return true;
}

function updatePassword($id, $token, $password) {
    global $connection;
    $query = "UPDATE user SET ";
    $query .= "user_password = '{$password}' ";
    $query .= "WHERE user_id = {$id} AND token = $token";
    if (!mysqli_query($connection, $query))
        die("UPDATE ERROR " . mysqli_error($connection));
}

function generateToken($id) {
    global $connection;
    $time = strtotime("now");
    $query = "SELECT * FROM user WHERE id = {$id}";
    if (login($id) && $result = getUserById($id)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $tokenString = substr($row["password"].$time, 0 , 12);
            $token = password_hash($tokenString, PASSWORD_BCRYPT, ["cost" => 12]);
            $query = "UPDATE user SET ";
            $query .= "token = '{$token}' ";
            $query .= "WHERE id = {$id}";
            if (!mysqli_query($connection, $query)) {
                die("UPDATE ERROR " . mysqli_error($connection));
                return null;
            }
            return $token;
        }
    }
    return null;
}

function logout($id) {
    global $connection;
    $query = "UPDATE user SET ";
    $query .= "token = NULL ";
    $query .= "WHERE id = {$id}";
    if (!mysqli_query($connection, $query))
        die("UPDATE ERROR " . mysqli_error($connection));
}
?>
