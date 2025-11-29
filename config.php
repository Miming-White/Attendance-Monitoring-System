<?php

    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "attendance_monitoring_system";
    $conn = "";
    
    try {
    $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
    } 
    catch (mysqli_sql_exception) {
        echo "Error! <br>";
    }

    if ($conn) {
        echo "";
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }
?>