<?php
    $page_title = "Register";
    include './layout/header.php';
?>
<div class="d-flex justify-content-evenly">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo $page_title; ?></h5>
        <form action="register_action.php" method="post">
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