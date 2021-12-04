<?php
    $page_title = "User Management";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }

    if($_SESSION['is_logged']['user_lvl'] != 2){
        $_SESSION['message_error'] = "Access denied, authorized Admin only.";
        header('location: dashboard.php');
    }
    
    //query list user
    $req_user = "SELECT fullname, email, user_id, datetime_created FROM user";
    $list_user = $conn->query($req_user);
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $url->base_url().'dashboard.php'; ?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title ?></li>
  </ol>
</nav>
<h1><?php echo $page_title?></h1>

<hr>

<div class="float-end">
    <a class="btn btn-success" href="<?php echo $url->base_url().'create_user.php'; ?>" role="button">Create User</a>
</div>

<table class="table table-hover mb-5">
    <thead>
        <tr>
            <th>id</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Date Join</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = $list_user->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['user_id']?></td>
            <td><?php echo $row['fullname'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo date("d-m-Y H:i A", strtotime($row['datetime_created']))?></td>
            
            <td>
                <a class="btn btn-primary" href="<?php echo $url->base_url()?>profile.php?user_id=<?php echo $row['user_id']?>" role="button">Detail</a>
                
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<?php
    include './layout/footer.php';
?>