<!-- Connect to the New Database  -->


<?php $dsn = 'mysql:host=localhost;dbname=phase2';
$username = 'root';
$password = '';
$db = new PDO($dsn, $username, $password);
//set error mode to exception 
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
?>





