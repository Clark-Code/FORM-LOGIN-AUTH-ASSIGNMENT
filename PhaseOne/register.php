<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>


<main class="container">
    <h1>Sign Up</h1>
    <p>Please fill this form to create an account.</p>
    <form action="save-registration.php" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
        <div class="form-group">
            <input type="reset" class="btn btn-danger" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</main>

<?php require_once('footer.php'); ?>