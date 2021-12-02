<?php
    $page_title = "Respond";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }
?>
    
    <h1>this is respond</h1>

    
<?php
    include './layout/footer.php';
?>