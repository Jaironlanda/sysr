<?php
session_start();
require './db-config/db.php';



// senetize input
$login_user = array(
    'email' => FILTER_VALIDATE_EMAIL,
);

$user_input = filter_input_array(INPUT_POST, $login_user);
$login_sql = "SELECT id, fullname, email, pswd FROM user WHERE email='".$user_input['email']."'";
$login = $conn->query($login_sql);

if ($login->num_rows == 1){
    $row = $login->fetch_assoc();
    if(password_verify($_POST['pswd'], $row['pswd'])){
        // set session
        $email = $row['email'];
        $id = $row['id'];
        $fullname = $row['fullname'];
        
        $_SESSION['is_logged'] = ['email' => $email, 'id' => $id, 'fullname' => $fullname];
        $_SESSION['message_noti'] = "Welcome";
        header('location: dashboard.php');
    }
    
}else{
   $_SESSION['message_error'] = "Invalid email or password.";
   header('location: login.php');
}

function check_hash($string)
{
    # code...
}
?>