<?php
    $page_title = "Dashboard";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }

    echo $_SESSION['is_logged']['email'];
?>

<h1><?php echo $page_title?></h1>
<h2>Welcome <?php echo $_SESSION['is_logged']['fullname'];?></h2>
<a href="logout.php">Logout</a>
<?php
    include './layout/footer.php';
?>