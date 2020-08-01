<!-- made by Andrew Clark for COMP1006 - Phase One Assignment -->
<!--Revised by Andre Clark for COMP1006 - Phase Two Assignment-->

<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>


<body>
    <div class="container">
        <header>
            <h1 class="ch1"> COMP1006 - Phase Two</h1>
        </header>

        <!-- PHP Script to allow DB updating  -->
        <?php

        $id = null;
        $firstname = null;
        $lastname = null;
        $email = null;
        $location = null;
        $skills = null;
        $photo = null;
        $social_media = null;



        //check to see if updating
        if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
            //grab id from URL
            $id = filter_input(INPUT_GET, 'id');

            //connect to db
            require_once('connect.php');

            //set up sql query
            $sql = "SELECT * FROM persons WHERE user_id = :user_id;";

            //prepare statement
            $statement = $db->prepare($sql);

            //bind Params
            $statement->bindParam(':user_id', $id);

            //execute
            $statement->execute();

            //fetchAll
            $records = $statement->fetchAll();

            //foreach loop to loop through records

            foreach ($records as $record) :
                $firstname = $record['first_name'];
                $lastname = $record['last_name'];
                $email = $record['email'];
                $location = $record['location'];
                $skills = $record['skills'];
                $photo = $record['photo'];
                $social_media = $record['social_media'];
            endforeach;

            //close connection
            $statement->closeCursor();
        }

        ?>

        <!-- form setup -->
        <main class="border border-dark main">
            <form action="process.php" method="post" enctype="multipart/form-data" class="form">
                <div>
                    <!-- add hidden input for id if editing  -->
                    <input type="hidden" name="user_id" value="<?php echo $id; ?>">

                    <!-- basic form to gather user info -->
                    <!-- First Name-->
                    <label for="fname"> Your First Name </label>
                    <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $firstname; ?>">

                    <!-- Last Name-->
                    <label for="lname"> Your Last Name </label>
                    <input type="text" name="lname" class="form-control" id="lname" value="<?php echo $lastname; ?>">

                    <!-- Email-->
                    <label for="email"> Your Email </label>
                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>">

                    <!--Location-->
                    <label for="location"> Your Location </label>
                    <input type="text" name="location" class="form-control" id="location"
                        value="<?php echo $location; ?>">

                    <!-- Skills-->
                    <label for="skills"> Your Skills</label>
                    <input type="text" name="skills" class="form-control" id="skills" value="<?php echo $skills; ?>">

                    <!-- Social Media-->
                    <label for="social_media"> Social Media Link</label>
                    <input type="url" name="social_media" class="form-control" id="social_media"
                        value="<?php echo $social_media; ?>">

                    <label for="photo"> Profile Picture</label>

                </div>
                <div>
                    <!-- Profile Image-->
                    <input type="file" name="photo" class="form-group" id="photo" value="<?php echo $photo; ?>">
                </div>

                <input type="submit" name="submit" id="send" value="Send & Share" class="btn btn-dark">
            </form>
        </main>
    </div>

</body>

<?php require_once('footer.php'); ?>