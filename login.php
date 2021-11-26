<?php
    $page_title = "Login";
    include './layout/header.php';
?>
<div class="d-flex justify-content-center">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo $page_title; ?></h5>
        <form action="login_action.php" method="post">
        <div class="mb-3">
            <label for="InputEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="InputEmail" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" name="pswd" id="InputPassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</div>
<?php
    include './layout/footer.php';
?>