<!-- Connect to the New Database  -->


<?php $dsn = 'mysql:host=172.31.22.43; dbname=Andrew100073101';
$username = 'Andrew100073101';
$password = 'LhlSP8hk1P';
$db = new PDO($dsn, $username, $password);
//set error mode to exception 
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>





<!-- $dsn = 'mysql:host=localhost;dbname=phase2';
$username = 'root';
$password = '';
$db = new PDO($dsn, $username, $password);
//set error mode to exception 
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); -->