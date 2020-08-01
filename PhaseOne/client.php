<?php require_once('auth.php'); ?>
<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>
<!-- made by Andrew Clark for COMP1006 - Phase One Assignment -->
<!--Revised by Andre Clark for COMP1006 - Phase Two Assignment-->

<body>
    <div class="container">
        <header>
            <h1 class="ch1"> COMP1006 - Phase Two</h1>
        </header>
        <main>

            <?php

            try {

                //connect to db 
                require_once('connect.php');

                //SQL Statment
                $sql = "SELECT * FROM persons;";

                //prepare query
                $statement = $db->prepare($sql);

                //execute
                $statement->execute();

                //use Fetch All to Store Results
                $records = $statement->fetchAll();

                //create a table with echo

                echo "<table class='table table-dark'><thead><th scope='col'>First Name</th><th scope='col'>Last Name</th><th scope='col'>Email</th><th scope='col'>Location</th><th scope='col'>Skills</th><th scope='col'>Image</th><th scope='col'>Social Media</th></thead><tbody>";

                foreach ($records as $record) {

                    echo "<tr><td>" . $record['first_name'] .
                        "</td><td>" . $record['last_name'] .
                        "</td><td>" . $record['email'] .
                        "</td><td>" . $record['location'] .
                        "</td><td>" . $record['skills'] .
                        "</td><td><img class='img-thumbnail' src='images/" . $record['photo'] . "' alt='" . $record['photo'] . "'>
                        </td><td><a href='" . $record['social_media'] . "'> Visit Now </a> 
                        </td><td><a href='delete.php?id=" . $record['user_id'] .
                        "' class='btn btn-danger'>Delete</a></td><td><a href='index.php?id=" .
                        $record['user_id'] . "' class='btn btn-info'>Edit</a></td></tr>";
                }

                echo "</tbody></table>";

                //close connection
                $statement->closeCursor();

                //error catching
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p> $error_message </p>";
            }
            ?>
            <a href="index.php" id="back" class="btn btn-success"> Back to Form </a>
        </main>
    </div>

</body>

<?php require_once('footer.php'); ?>