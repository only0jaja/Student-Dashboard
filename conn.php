<?php
   $server = "localhost";
   $username = "root";  
   $password = "";
   $dbname = "student_dashboard";

    if(!$conn = mysqli_connect($server, $username, $password, $dbname)){
        die("failed to connect!");
        
    }
    
?>