<?php

session_start();
function isUserValid($name, $email, $password, $rePassword)
{
    $isValid = false;
    $nameErr = false;
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = true;
        echo "Only letters and white space allowed";
    }
    $emailErr = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = true;
        echo "Invalid email format";
    }
    $passwordErr = false;
    if (strlen($password) < 8) {
        $passwordErr = true;
        echo "Password must be at least 8 characters long";
    }
    if ($password != $rePassword) {
        $passwordErr = true;
        echo "password doesn't match";
    }
    if ($nameErr == false && $emailErr == false && $passwordErr == false) {
        $isValid = true;
    }
    return $isValid;
}

function registerUserInJsonFile($data)
{

    $allData = json_decode(file_get_contents('storage/users.json'), true);
    array_push($allData, $data);
    $allData = json_encode($allData);
    file_put_contents('storage/users.json', $allData, JSON_PRETTY_PRINT);
    header('location:login.php');
}

function loginUser($username, $password)
{
    $allData = file_get_contents('storage/users.json');
    $allData = json_decode($allData, true);
    $isUserExist = false;
    foreach ($allData as $data) {
        if ($data['username'] == $username && $data['password'] == $password) {
            $isUserExist = true;
            $_SESSION['user'] = $username;
            return $isUserExist;
        }
    }
    return $isUserExist;
}
function unique($username, $email)
{
    $allData = file_get_contents('storage/users.json');
    $allData = json_decode($allData, true);
    $isUnique = false;
    foreach ($allData as $data) {
        if ($data['username'] == $username || $data['email'] == $email) {
            $isUnique = true;
            echo "the username or email is used";
            return $isUnique;
        }
    }
}
