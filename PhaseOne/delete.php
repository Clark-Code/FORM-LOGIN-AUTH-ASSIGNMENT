<!-- allow user to delete records -->

<?php
//turn on output buffering
ob_start();


try {
    //grab user-id and store in var
    $id = filter_input(INPUT_GET, 'id');

    //connect to db
    require_once('connect.php');

    //setup sql statement
    $sql = "DELETE FROM persons WHERE user_id = :user_id;";

    //prepare statment
    $statement = $db->prepare($sql);

    //bindParam
    $statement->bindParam(':user_id', $id);

    //execute 
    $statement->execute();

    //close connection 
    $statement->closeCursor();

    //send user back to client.php
    header('location:client.php');
}
//error handling
catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>$error_message</p>";
}

//send output buffer
ob_flush();
?>