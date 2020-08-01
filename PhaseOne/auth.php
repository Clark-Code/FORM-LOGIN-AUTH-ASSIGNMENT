<?php

//check for existing session
session_start();

//check if session var is empty
if (empty($_SESSION['id'])) {
    header('location:login.php');
    exit();
}