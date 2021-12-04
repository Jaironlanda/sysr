<?php
    $page_title = "Dashboard";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }
    // Get user level
    $user_lvl = $_SESSION['is_logged']['user_lvl'];
    
    // query submited user report
    if($user_lvl !=1){
        // get all user report
        $req_report = "SELECT * FROM report ORDER BY datetime_created ASC";
        $req_user = "SELECT * FROM user ORDER BY datetime_created ASC";
        $list_user = $conn->query($req_user);
    }else {
        // request only user report
        $req_report = "SELECT * FROM report WHERE reporter_id= '". $_SESSION['is_logged']['user_id']."' ORDER BY datetime_created ASC";
    }
    
    $list_report = $conn->query($req_report);
    
    if(!$list_report){
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit;
    }
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
  </ol>
</nav>
<h1><?php echo $page_title?></h1>
<h5>Welcome <?php echo $_SESSION['is_logged']['fullname'];?></h5>
<hr>

<?php
    if ($user_lvl !=1){
?>
<div class="row mb-3">
<div class="col-sm-3 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Report(s)</h5>
        <p class="card-text"><?php echo $list_report->num_rows?></p>
      </div>
    </div>
  </div>
  <div class="col-sm-3 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Registered User(s)</h5>
        <p class="card-text"><?php echo $list_user->num_rows?></p>
        <a href="<?php echo $url->base_url()?>userlist.php" class="btn btn-primary">Manage</a>
      </div>
    </div>
  </div>
</div>
<?php 
    }
?>
<div class="float-end">
    <a class="btn btn-success" href="<?php echo $url->base_url().'reportForm.php'; ?>" role="button">Submit Complaint</a>
</div>

<table class="table table-hover mb-5">
    <thead>
        <tr>
            <th>id</th>
            <th>Topic</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = $list_report->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['report_id']?></td>
            <td><?php echo htmlspecialchars($row['title']);?></td>
            <td><?php echo date("d-m-Y H:i A", strtotime($row['datetime_created']))?></td>
            
            <td>
                <a class="btn btn-primary" href="<?php echo $url->base_url()?>viewreport.php?id=<?php echo $row['report_id']?>" role="button">Detail</a>
                
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