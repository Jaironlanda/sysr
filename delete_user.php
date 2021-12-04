<?php
    session_start();
    require './db-config/db.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }

    if($_SESSION['is_logged']['user_lvl'] != 2){
        $_SESSION['message_error'] = "Access denied, authorized Admin only.";
        header('location: dashboard.php');
    }
    $user_id = $_GET['user_id'];
    $user_id_session = $_SESSION['is_logged']['user_id'];
    if(!empty($user_id)){
        if($user_id_session == $user_id){
            $_SESSION['message_error'] = "Please don't delete yourself 😔.";
            header('location: userlist.php');
            exit;
        }

        $req_user = "SELECT * FROM user WHERE user_id='".$user_id."'";
        if($conn->query($req_user)){
            $delete_user = "DELETE FROM user WHERE user_id='".$user_id."'";
            $conn->query($delete_user);

            $_SESSION['message_noti'] = "Success delete user";
            header('location: userlist.php');
        }
    }else {
        header('location: https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        exit;
    }
?>