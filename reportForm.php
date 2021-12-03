<?php
    $page_title = "Submit Complaint";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }

    //prepare report type
    $report_type_sql = "SELECT type_id, name FROM reportType";
    $report_type = $conn->query($report_type_sql);

    // var_dump($report_type->num_rows);
    // while ($row = $report_type->fetch_assoc()) {
    //     echo $row['name'];
    // }
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $url->base_url().'dashboard.php'; ?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Submit Complaint</li>
  </ol>
</nav>
<h1><?php echo $page_title?></h1>
<hr>  
<div class="col-md-6 offset-md-3 mb-5">
    <div class="card">
        <div class="card-body">
            <form action="report_action.php" method="post">
                <div class="mb-3">
                <label for="" class="form-label">Complaint Type</label>
                <select class="form-select" name="report_type_id" required>
                    <option value="" selected>Please select</option>
                    <?php
                        while ($row = $report_type->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['type_id']?>"><?php echo $row['name']?></option>
                    <?php
                        }
                    ?>
                </select>
                </div>
                <div class="mb-3">
                    <label for="InputUsername" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="InputTitle" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="InputUsername" class="form-label">Report By</label>
                    <input type="hidden" name="reporter_id" value="<?php echo $_SESSION['is_logged']['user_id'];?>">
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