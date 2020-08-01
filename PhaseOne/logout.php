<?php

//check for existing session
session_start();

//unset any var
session_unset();


//destroy session
session_destroy();


//send back to login page
header('location:login.php');