<?php
    $page_title = "Create User";
    include './layout/header.php';

    if($_SESSION['is_logged']['user_lvl'] != 2){
        $_SESSION['message_error'] = "Access denied, authorized Admin only.";
        header('location: dashboard.php');
    }

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $url->base_url().'dashboard.php'; ?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title ?></li>
  </ol>
</nav>
<h1><?php echo $page_title?></h1>

<hr>
<div class="col-md-6 offset-md-3 mb-5">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo $page_title; ?></h5>
        <form action="create_user_action.php" method="post">
        <div class="mb-3">
          <label for="" class="form-label">User Level</label>
          <select class="form-select" name="user_lvl" required>
            <option value="">Please select</option>
            <option value="1">User</option>
            <option value="2">Admin</option>
          </select>
        </div>
        <div class="mb-3">
            <label for="InputFullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="fullname" id="InputFullname" aria-describedby="fullnamelHelp" required>
            <div id="usernameHelp" class="form-text">Example: John Jitai</div>
        </div>
        <div class="mb-3">
            <label for="InputEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="InputEmail" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" name="pswd" id="InputPassword" required>
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirmPswd" id="InputPassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</div>
<?php
    include './layout/footer.php';
?>