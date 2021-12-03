<?php
session_start();
require './db-config/db.php';



// senetize input
$login_user = array(
    'email' => FILTER_VALIDATE_EMAIL,
);

$user_input = filter_input_array(INPUT_POST, $login_user);
$login_sql = "SELECT user_id, user_lvl, fullname, email, pswd FROM user WHERE email='".$user_input['email']."'";
$login = $conn->query($login_sql);

if ($login->num_rows == 1){
    $row = $login->fetch_assoc();
    if(password_verify($_POST['pswd'], $row['pswd'])){
        // set session
        $email = $row['email'];
        $user_id = $row['user_id'];
        $fullname = $row['fullname'];
        $user_lvl = $row['user_lvl'];
        
        $_SESSION['is_logged'] = ['email' => $email, 'user_id' => $user_id, 'fullname' => $fullname, 'user_lvl' => $user_lvl];
        $_SESSION['message_noti'] = "Welcome";
        header('location: dashboard.php');
    }
    
}else{
   $_SESSION['message_error'] = "Invalid email or password.";
   header('location: login.php');
}
?>