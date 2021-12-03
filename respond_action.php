<?php
session_start();
require './db-config/db.php';

    $respond = array(
        'report_id' => FILTER_SANITIZE_NUMBER_INT,
        'content' => FILTER_SANITIZE_STRING,
        'admin_id' => FILTER_SANITIZE_NUMBER_INT
    );

    $respond_submit = filter_input_array(INPUT_POST, $respond);
    $datetime = date("Y-m-d H:i:s");

    $sql = "INSERT INTO feedback (content, report_id, admin_id, datetime_created) 
    VALUES ('".$respond_submit['content']."', '".$respond_submit['report_id']."', '".$respond_submit['admin_id']."', '".$datetime."')";

    $create_respond = $conn->query($sql);

    if (!$create_respond){
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit;
    }

    $_SESSION['message_noti'] = "Successfully created new feedback";
    header('location: dashboard.php');
?>