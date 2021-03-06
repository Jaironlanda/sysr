<?php
    $page_title = "Respond";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }

    if($_SESSION['is_logged']['user_lvl'] != 2){
        $_SESSION['message_error'] = "Access denied, authorized Admin only.";
        header('location: dashboard.php');
    }
    $report_id = $_GET['report_id'];
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $url->base_url().'dashboard.php'; ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $url->base_url().'viewreport.php?id='.$report_id; ?>">View Report</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
  </ol>
</nav>
<h1><?php echo $page_title?></h1>
<hr>  
    
<div class="col-md-6 offset-md-3 mb-5">
    <div class="card">
        <div class="card-body">
            <form action="respond_action.php" method="post">
                <div class="mb-3">
                  <label for="" class="form-label">Report Ref Id</label>
                  <input type="hidden" name="report_id" value="<?php echo $report_id;?>">
                  <input type="text" class="form-control" value="<?php echo $report_id;?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="InputUsername" class="form-label">Respond By</label>
                    <input type="hidden" name="admin_id" value="<?php echo $_SESSION['is_logged']['user_id'];?>">
                    <input type="text" class="form-control" name="fullname" value="<?php echo $_SESSION['is_logged']['fullname'];?>" disabled>
                </div>
                <a class="btn btn-secondary" href="<?php echo $url->base_url().'dashboard.php'; ?>" role="button">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
               
            </form>
        </div>
    </div>
</div>
<?php
    include './layout/footer.php';
?>