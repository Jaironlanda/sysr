<?php
    $page_title = "Dashboard";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
    }

    // query submited user report
    $req_report = "SELECT * FROM report WHERE reporter_id= '". $_SESSION['is_logged']['id']."' ORDER BY datetime_created ASC";
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

<div class="float-end">
    <a name="" id="" class="btn btn-success" href="<?php echo $url->base_url().'reportForm.php'; ?>" role="button">Submit Complaint</a>
</div>

<table class="table table-hover">
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
            <td><?php echo $row['id']?></td>
            <td><?php echo htmlspecialchars($row['title']);?></td>
            <td><?php echo date("d-m-Y H:i A", strtotime($row['datetime_created']))?></td>
            
            <td>
                <a class="btn btn-primary" href="viewreport.php?id=<?php echo $row['id']?>" role="button">Detail</a>
                
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