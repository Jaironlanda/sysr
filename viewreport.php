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
        r.report_id,
        r.title, 
        r.content, 
        r.report_type_id, 
        r.datetime_created, 
        u.fullname, 
        u.email, 
        t.type_id, 
        t.name 
    FROM report AS r
    INNER JOIN user AS u ON r.reporter_id=u.user_id 
    INNER JOIN reportType AS t ON r.report_type_id=t.type_id
    WHERE r.report_id='".$id."';";

    $view_report = $conn->query($view);
    
    if(!$view_report){
        echo "Error: " . $view . "<br>" . mysqli_error($conn);
        exit;
    }
    $row_viewreport = $view_report->fetch_assoc();

    $req_feedback = "SELECT 
        f.feedback_id, 
        f.admin_id, 
        f.report_id,
        f.datetime_created,
        u.user_id, 
        u.fullname 
    FROM feedback AS f
    INNER JOIN user AS u ON f.admin_id=u.user_id
    WHERE f.report_id='".$id."' ORDER BY f.datetime_created ASC";

    $list_feedback = $conn->query($req_feedback);

    if(!$list_feedback){
        echo "Error: " . $req_feedback . "<br>" . mysqli_error($conn);
        exit;
    }
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $url->base_url().'dashboard.php'; ?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
  </ol>
</nav>
<h1><?php echo $page_title?></h1>
<hr>
<div class="row mb-5">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <form>
                <div class="mb-3">
                        <label for="" class="form-label">Report ID</label>
                        <input type="text" class="form-control" value="<?php echo $row_viewreport['report_id']?>" disabled>
                    </div>
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
                    <?php
                        $user_lvl = $_SESSION['is_logged']['user_lvl'];
                        if($user_lvl !=1){
                    ?>
                    <a class="btn btn-primary" href="<?php echo $url->base_url().'respond.php?report_id='.$id; ?>" role="button">Respond</a>
                    <?php
                        }
                    ?>            
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Feedback(s)</h5>
                <?php
                    while ($row_feedback = $list_feedback->fetch_assoc()) {
                        // print_r($row_feedback);
                ?>
                    <p>
                        <a href="<?php echo $url->base_url().'viewrespond.php?report_id='.$row_feedback['report_id'].'&feedback_id='.$row_feedback['feedback_id']; ?>" class="text-reset">
                            Respond By: <?php echo $row_feedback['fullname']?> | 
                            <?php echo date("d-m-Y H:i A", strtotime($row_feedback['datetime_created']));?>
                        </a>
                    </p>
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- <div class="col-md-6 mb-5">
    <div class="card">
        <div class="card-body">
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
                <a class="btn btn-primary" href="<?php echo $url->base_url().'respond.php?report_id='.$id; ?>" role="button">Respond</a>             
            </form>
        </div>
    </div>
</div> -->
    
<?php
    include './layout/footer.php';
?>