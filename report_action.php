<?php
session_start();
require './db-config/db.php';

    $report = array(
        'report_type_id' => FILTER_SANITIZE_NUMBER_INT,
        'title' => FILTER_SANITIZE_STRING,
        'content' => FILTER_SANITIZE_STRING,
        'reporter_id' => FILTER_SANITIZE_NUMBER_INT
    );

    $report_submit = filter_input_array(INPUT_POST, $report);
    $datetime = date("Y-m-d H:i:s");

    $sql = "INSERT INTO report (title, content, report_type_id, reporter_id, datetime_created) 
    VALUES ('".$report_submit['title']."', '".$report_submit['content']."', '".$report_submit['report_type_id']."', '".$report_submit['reporter_id']."', '".$datetime."')";

    $create_report = $conn->query($sql);

    if (!$create_report){
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit;
    }

    $_SESSION['message_noti'] = "Successfully created new report";
    header('location: dashboard.php');

?>