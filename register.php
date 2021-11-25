<?php
    $page_title = "Register";
    include './layout/header.php';
?>
<div class="d-flex justify-content-evenly">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo $page_title; ?></h5>
        <form >
        <div class="mb-3">
            <label for="InputUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="InputUsername" aria-describedby="usernamelHelp">
            <div id="usernameHelp" class="form-text">Example: johnjitai</div>
        </div>
        <div class="mb-3">
            <label for="InputFullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="InputFullname" aria-describedby="fullnamelHelp">
            <div id="usernameHelp" class="form-text">Example: John Jitai</div>
        </div>
        <div class="mb-3">
            <label for="InputEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="InputPassword">
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="InputPassword">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</div>
<?php
    include './layout/footer.php';
?>