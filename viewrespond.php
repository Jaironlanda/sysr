<?php
    $page_title = "View Respond";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }
    $report_id = $_GET['report_id'];
    $feedback_id = $_GET['feedback_id'];

    $req_feedback = "SELECT 
        f.feedback_id, 
        f.content, 
        f.admin_id, 
        f.report_id,
        f.datetime_created,
        u.user_id, 
        u.fullname 
    FROM feedback AS f
    INNER JOIN user AS u ON f.admin_id=u.user_id
    WHERE f.feedback_id='".$feedback_id."' ORDER BY f.datetime_created ASC";

    $get_feedback = $conn->query($req_feedback);

    if(!$get_feedback){
        echo "Error: " . $get_feedback . "<br>" . mysqli_error($conn);
        exit;
    }

    $row_feedback = $get_feedback->fetch_assoc();
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
                    <textarea class="form-control" name="content" id="" rows="4" disabled><?php echo $row_feedback['content']?></textarea>
                </div>
                <div class="mb-3">
                    <label for="InputUsername" class="form-label">Respond By</label>
                    <input type="text" class="form-control" name="fullname" value="<?php echo  $row_feedback['fullname']?>" disabled>
                </div>
                <a class="btn btn-secondary" href="<?php echo $url->base_url().'viewreport.php?id='.$report_id; ?>" role="button">Back to report</a>
            </form>
        </div>
    </div>
</div>
<?php
    include './layout/footer.php';
?>