<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>


<main class="container login">
    <h1> Log In </h1>
    <form action="validate.php" method="post">
        <fieldset class="form-group">
            <label for="username" class="col-sm-2">User Name</label>
            <input name="username" type="text" class="form-control" id="username" required>
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-2">Password</label>
            <input name="password" required type="password" class="form-control">
        </fieldset>
        <input type="submit" value="Log In!" name="submit" class="btn btn-success">
        <a href="register.php" class="btn btn-info" id="signup" role="button">Sign Up</a>
    </form>
</main>



<?php require_once('footer.php'); ?>