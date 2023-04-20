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

// read
function isValidUser($id, $token) {
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$id} AND token = $token";
    if (mysqli_query($connection, $query))
        return false;
    return true;
}

function getAllUsers($id, $token) {
    if (!isValidUser($id, $token))
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

function isDuplicateUsername($name) {
    global $connection;
    $query = "SELECT * FROM user WHERE user_username = '{$name}'";

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

function updateUser($id, $firstname, $lastname, $username, $image, $role, $email, $password) {
    global $connection;
    $query = "UPDATE user SET ";
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

function generateToken($id) {
    global $connection;
    $time = strtotime("now");
    $query = "SELECT * FROM user WHERE id = {$id}";
    if ($result = getUserById($id)) {
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
    mysqli_query($connection, $query);
}

?>
