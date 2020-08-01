<?php

require_once('header.php');




require_once "connect.php";

//grab user info
$user = trim(filter_input(INPUT_POST, 'username'));
$confirm_password = trim(filter_input(INPUT_POST, 'confirm_password'));
$password = trim(filter_input(INPUT_POST, 'password'));


//set flag var

$ok = true;

//validate 

//username
if (empty($user)) {
    $ok = false;
    echo "<p class='save'> Please enter a username </p>";
}

//password
if (empty($password)) {
    $ok = false;
    echo "<p class='save'> Please enter a Password </p>";
}

//confirm
if (empty($confirm_password)) {
    $ok = false;
    echo "<p class='save'> Your password must match </p>";
    echo "<a href='register.php' class='btn btn-info' id='back' role='button'>Go Back</a>";
}


if ($ok === true) {

    try {
        //connect to db
        require_once('connect.php');

        //SQL Query
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password);";

        //prepare statment
        $statement = $db->prepare($sql);

        //hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //bind params
        $statement->bindParam(':username', $user);
        $statement->bindParam(':password', $hashed_password);

        //execute 
        $statement->execute();

        //close connection
        $statement->closeCursor();

        echo "<p class='register'> You are now Registered! Click <a href='login.php'>Here to login </p>";
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        //show error message to user
        echo "<p> Sorry! We weren't able to process your submission at this time. We've alerted our admins and will let you know when things are fixed! </p> ";
        echo $error_message;
        //email app admin with error
        mail('youremailhere@gmail.com', 'App Error ', 'Error :' . $error_message);
    }
}


require_once('footer.php');