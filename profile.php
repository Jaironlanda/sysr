<?php
    $page_title = "User Profile";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }
    
    $user_lvl = $_SESSION['is_logged']['user_lvl']; 

    //if user id is set, allow admin only
    if(isset($_GET['user_id'])){
        if($user_lvl !=2){
            $_SESSION['message_error'] = "Access denied, Authorize user only.";
            header('location: dashboard.php');
        }
        //query list user
        $req_user = "SELECT user_lvl, fullname, email, user_id, datetime_created FROM user WHERE user_id='".$_GET['user_id']."'";
    }else {
        $req_user = "SELECT user_lvl, fullname, email, user_id, datetime_created FROM user WHERE user_id='".$_SESSION['is_logged']['user_id']."'";
    }

    
    
    $list_user = $conn->query($req_user);
    $row = $list_user->fetch_assoc();
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $url->base_url().'dashboard.php'; ?>">Dashboard</a></li>
    <?php 
        if($user_lvl != 1){
    ?>
    <li class="breadcrumb-item"><a href="<?php echo $url->base_url().'userlist.php'; ?>">User Management</a></li>
    <?php
        }
    ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
  </ol>
</nav>
<h1><?php echo $page_title?></h1>
<hr>  
<div class="row">
    <div class="col-md-6 mb-5">
        <div class="card">
            <div class="card-body">
                <form action="report_action.php" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">User Level</label>
                        <input type="text" class="form-control" name="user_lvl" value="<?php echo $row['user_lvl'] .' | '. $lvl_name = ($row['user_lvl'] !=1 ? "Admin" : 'User');?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="InputUsername" class="form-label">Full name</label>
                        <input type="text" class="form-control" name="title" id="InputTitle" value="<?php echo $row['fullname'];?>" disabled>
                    </div>                
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-5">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Account Settings</h5>
            <form action="acc_settings.php" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="hidden" name="old_email" value="<?php echo $row['email'];?>">
                    <input type="email" class="form-control" value="<?php echo $row['email'];?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">New Email</label>
                    <input type="email" class="form-control" name="email" placeholder="yourmail@domain.com" required>
                </div>
                <!-- Define setting id, 1=> email, 2=> password -->
                <input type="hidden" name="setting_type" value="1"> 
                <button type="submit" class="btn btn-primary">Updated Email</button>
            </form>
            <hr>
            <form action="acc_settings.php" method="post">
                <?php
                    if($user_lvl !=2){
                ?>
                <div class="mb-3">
                    <label for="pswd" class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="old_pswd" required>
                </div>
                <?php
                    }
                ?>

                <div class="mb-3">
                    <label for="pswd" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_pswd" required>
                </div> 
                <div class="mb-3">
                    <label for="pswd" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_pswd" required>
                </div>
                <input type="hidden" name="setting_type" value="2">               
                <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">               
                <button type="submit" class="btn btn-primary">Updated Password</button>
               
            </form>
        </div>
    </div>
</div>
</div>

    
<?php
    include './layout/footer.php';
?>