<?php
session_start();
require './db-config/db.php';
require './helper/pswdhash.php';

$newHash = new CreateHash();
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
        header("location: create_user.php");
    }else{
        $sql = "INSERT INTO user (user_lvl, fullname, email, pswd, datetime_created) 
        VALUES ('" .$_POST['user_lvl']. "','" .$user_input['fullname']. "', '" .$user_input['email']. "', '" .$newHash->pswd_hash($_POST['pswd']). "', '".$datetime."')";
    
        $register = $conn->query($sql);
    
        if(!$register){
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $_SESSION['message_noti'] = "Success Create new user";
        header("location: create_user.php");
    }
}else{
    $_SESSION['message_error'] = "Password not match";
    header("location: create_user.php");
}


?>