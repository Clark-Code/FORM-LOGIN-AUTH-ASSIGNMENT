<?php

require_once('connect.php');

//set flag var
$ok = true;

// grab info 

$uname = trim(filter_input(INPUT_POST, 'username'));
$upassword = trim(filter_input(INPUT_POST, 'password'));

//username empty
if (empty($uname)) {
    echo "<p> Please provide your username! </p>";
    $ok = false;
}

//passwaord empty
if (empty($upassword)) {
    echo "<p> Please provide your password! </p>";
    $ok = false;
}

//validate 

if ($ok === true) {

    try {
        //set up query to see if a username matches 
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        //prepare 
        $statement = $db->prepare($sql);
        //bind 
        $statement->bindParam(":username", $uname);
        //execute
        $statement->execute();
        //is the data present in the database? 
        if ($statement->rowCount() == 1) {
            //if so fetch it 
            if ($row = $statement->fetch()) {
                //use password verify to check the users password against the hash password 
                if (password_verify($upassword, $row["password"])) {
                    //password matches, start session; 
                    session_start();
                    //create session variables 
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    //direct user to restricted page 
                    header("location:client.php");
                } else {
                    echo "<p> Problem validating your password</p>";
                }
            } else {
                echo "<p> Error accessing your data</p>";
            }
        } else {
            echo "<p> No user found</p>";
        }
        //close database connection
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        //show error message to user
        echo "<p> Sorry! We weren't able to process your submission at this time. We've alerted our admins and will let you know when things are fixed! </p> ";
        echo $error_message;
        //email app admin with error
        mail('youremailhere@gmail.com', 'App Error ', 'Error :' . $error_message);
    }
}