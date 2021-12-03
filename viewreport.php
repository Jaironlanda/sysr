<?php

    $page_title = "View report";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }

    // query report view
    $id = $_GET['id'];
    $view = "SELECT
        r.id,
        r.title, 
        r.content, 
        r.report_type_id, 
        r.datetime_created, 
        u.fullname, 
        u.email, 
        t.id, 
        t.name 
    FROM report AS r
    INNER JOIN user AS u ON r.reporter_id=u.id 
    INNER JOIN reportType AS t ON r.report_type_id=t.id
    WHERE r.id='".$id."';";

    $view_report = $conn->query($view);
    
    if(!$view_report){
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit;
    }
    $row_viewreport = $view_report->fetch_assoc();
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $url->base_url().'dashboard.php'; ?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">View report</li>
  </ol>
</nav>
<div class="col-md-6 offset-md-3 mb-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo $page_title; ?></h5>
            <form>
                <div class="mb-3">
                <label for="" class="form-label">Complaint Type</label>
                    <input type="text" class="form-control" name="title" id="InputTitle" value="<?php echo $row_viewreport['name']?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="InputUsername" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="InputTitle" value="<?php echo $row_viewreport['title']?>" id="InputTitle" disabled>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="" rows="4" disabled><?php echo htmlspecialchars($row_viewreport['content'])?></textarea>
                </div>
                <div class="mb-3">
                    <label for="InputUsername" class="form-label">Date Time created</label>
                    <input type="text" class="form-control" name="fullname" value="<?php echo date("d-m-Y H:i A", strtotime($row_viewreport['datetime_created']))?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="InputUsername" class="form-label">Report By</label>
                    <input type="text" class="form-control" name="fullname"value="<?php echo $row_viewreport['fullname']?>" disabled>
                </div>
                <a class="btn btn-danger" href="<?php echo $url->base_url().'dashboard.php'; ?>" role="button">Exit</a>               
            </form>
        </div>
    </div>
</div>
    
<?php
    include './layout/footer.php';
?>