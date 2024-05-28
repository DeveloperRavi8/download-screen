<?php

include("config.php");

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

if(empty($email) || empty($password)) {
    $response['error'] = true;
    $response['message'] = 'All fields are required';
    response($response);
}
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    if($row["password"] == $password) {
        $response["error"] = false; 
        $response["message"] = "LOGIN_SUCCESS";
    }else {
        $response["error"] = true;
        $response["message"] = "LOGIN_FAILED";
    }
}else {
    $sql_query = mysqli_query($conn, "INSERT INTO users(email, password) VALUES('$email', '$password')");
    if($sql_query) {
        $response['error'] = false;
        $response['message'] = "SIGNUP_SUCCESS";
    }else {
        $response["error"] = true;
        $response["message"] = "SIGNUP_FAILED";
    }
}

response($response);
?>