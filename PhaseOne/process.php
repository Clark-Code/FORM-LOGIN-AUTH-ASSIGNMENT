<?php require_once('header.php'); ?>
<!-- made by Andrew Clark for COMP1006 - Phase One Assignment -->
<!--Revised by Andre Clark for COMP1006 - Phase Two Assignment-->

<body>
    <div class="container">
        <header>
            <h1> Phase Two Assignment</h1>
        </header>
        <main>
            <?php

            //create variables to store form data
            $first_name = filter_input(INPUT_POST, 'fname');
            $last_name = filter_input(INPUT_POST, 'lname');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $location = filter_input(INPUT_POST, 'location');
            $skills = filter_input(INPUT_POST, 'skills');
            $social_media = filter_input(INPUT_POST, 'social_media');

            //photo
            $photo = $_FILES['photo']['name'];
            $photo_type = $_FILES['photo']['type'];
            $photo_size = $_FILES['photo']['size'];


            $id = null;
            $id = filter_input(INPUT_POST, 'user_id');

            //set up a flag variable

            $ok = true;

            //define image constants
            define('UPLOADPATH', 'images/');
            define('MAXFILESIZE', 32786);


            //validate

            // first name - last name  not empty

            if (empty($first_name) || empty($last_name)) {
                echo "<p class='error'>Please provide both first and last name!</p>";
                $ok = false;
            }

            //email not empty and proper format
            if (empty($email) || $email === false) {
                echo "<p class='error'>Please include your email in the proper format!</p>";
                $ok = false;
            }

            //location not empty
            if (empty($location)) {
                echo "<p class='error'>Please provide your location!</p>";
                $ok = false;
            }

            //skills not empty
            if (empty($skills)) {
                echo "<p class='error'>Please provide your skills!</p>";
                $ok = false;
            }

            // check photo is the right size and type 
            if ((($photo_type !== 'image/gif') || ($photo_type !== 'image/jpeg') || ($photo_type !== 'image/jpg') || ($photo_type !== 'image/png')) && ($photo_size < 0) && ($photo_size >= MAXFILESIZE)) {
                //making sure no upload errors 
                if ($_FILES['photo']['error'] !== 0) {
                    $ok = false;
                    echo "Please submit a photo that is a jpg, png or gif and less than 32kb";
                }
            }

            //social_media not empty
            if (empty($social_media)) {
                echo "<p class='error'>Please provide your social media!</p>";
                $ok = false;
            }


            //if form validates, try to connect to database and add info

            if ($ok === true) {
                try {

                    $target = UPLOADPATH . $photo;
                    move_uploaded_file($_FILES['photo']['tmp_name'], $target);

                    require_once('connect.php');

                    //allow updates/edits to table or add new values

                    //edit or update existing values
                    if (!empty($id)) {
                        $sql = "UPDATE persons SET first_name = :firstname, last_name = :lastname, email = :email, location = :location, skills = :skills, photo = :photo, social_media = :social_media WHERE user_id = :user_id;";
                    }
                    //add new value
                    else {
                        $sql = "INSERT INTO persons(first_name, last_name, email, location, skills, photo, social_media) VALUES (:firstname, :lastname, :email, :location, :skills, :photo, :social_media);";
                    }

                    //prepare statement
                    $statement = $db->prepare($sql);


                    // binds parameters to their values 
                    $statement->bindParam(':firstname', $first_name);
                    $statement->bindParam(':lastname', $last_name);
                    $statement->bindParam(':email', $email);
                    $statement->bindParam(':location', $location);
                    $statement->bindParam(':skills', $skills);
                    $statement->bindParam(':photo', $photo);
                    $statement->bindParam(':social_media', $social_media);

                    //if updating -> bind user_id
                    if (!empty($id)) {
                        $statement->bindParam(':user_id', $id);
                    }


                    // execute the statment 
                    $statement->execute();

                    // show message
                    echo "<div id='jumbo' class='jumbotron jumbotron-fluid border border-dark main'>";
                    echo "<p> Thank you For Your Information!</p>";
                    echo "<p> You Submitted the Following</p>";
                    echo "<p> First Name : $first_name</p>";
                    echo "<p> Last Name : $last_name</p>";
                    echo "<p> Email : $email</p>";
                    echo "<p> Location : $location</p>";
                    echo "<p> Skills : $skills</p>";
                    echo "<p> photo : $photo</p>";
                    echo "<p> social_media : $social_media</p>";
                    echo "</div>";

                    // close the db connection
                    $statement->closeCursor(); // fill in the correct method


                } catch (PDOException $e) {
                    $error_message = $e->getMessage();
                    //show error message to user
                    echo "<p> Sorry! We weren't able to process your submission at this time. We've alerted our admins and will let you know when things are fixed! </p> ";
                    echo $error_message;
                    //email app admin with error
                    mail('youremailhere@gmail.com', 'App Error ', 'Error :' . $error_message);
                }
            }

            ?>
            <a href="index.php" class="btn btn-success"> Back to Form </a>
        </main>
    </div>
</body>

<?php require_once('footer.php'); ?>