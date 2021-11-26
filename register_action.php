<?php
session_start();
require './db-config/db.php';

// senetize input
$register_user = array(
    'fullname' => FILTER_SANITIZE_STRING,
    'email' => FILTER_VALIDATE_EMAIL,
);

$user_input = filter_input_array(INPUT_POST, $register_user);
$datetime = date("Y-m-d H:i:s");
if($_POST['pswd'] === $_POST['confirmPswd']){
    
    //make sure email or username is not taken
    $userCheck_sql = "SELECT email FROM user WHERE email='".$user_input['email']."'";
    $userCheck = $conn->query($userCheck_sql);

    if($userCheck->num_rows >= 1){
        $_SESSION['message_error'] = $user_input['email'] . " is already exist!";        
        header("location: register.php");
    }else{
        $sql = "INSERT INTO user (fullname, email, pswd, datetime_created) 
        VALUES ('" .$user_input['fullname']. "', '" .$user_input['email']. "', '" .pswd_hash($_POST['pswd']). "', '".$datetime."')";
    
        $register = $conn->query($sql);
    
        if(!$register){
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $_SESSION['message_noti'] = "Success Register";
        header("location: login.php");
    }
}else{
    $_SESSION['message_error'] = "Password not match";
    header("location: register.php");
}

// Hash password before store in database
// $string = user password input
// PASSWORD_DEFAULT = algorithm hash ref: https://www.phptutorial.net/php-tutorial/php-password_hash/
function pswd_hash($string)
{
    return password_hash($string, PASSWORD_DEFAULT);
}
?>