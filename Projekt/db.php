<?php
header("Content-Type: application/json; charset=UTF-8");

define ("SERVERNAME", "fdb1034.awardspace.net");
define ("USERNAME", "4398985_mybase");
define ("PASSWORD", "28KochamPieski05");
define ("DBNAME", "4398985_mybase");
        
        // Create connection
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        // Check connection
        if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
        }
        
       
        ?>