<?php
session_start();

session_unset();
session_destroy();
//redirecting to login page
header("location: Login.php"); 

?>