<?php
    $page_title = "Dashboard";
    include './layout/header.php';

    if(!isset($_SESSION['is_logged'])){
        $_SESSION['message_error'] = "Access denied, please login.";
        header('location: login.php');
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
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Data Leak</td>
            <td>22/2/2022</td>
            <td>Pending</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Data Abuse</td>
            <td>22/2/2022</td>
            <td>Pending</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Use Data without permission</td>
            <td>22/2/2022</td>
            <td>Pending</td>
        </tr>
    </tbody>
</table>

<?php
    include './layout/footer.php';
?>