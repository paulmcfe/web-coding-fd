<?php
    // Store the database connection parameters
    $host = 'localhost';
    $user = 'logophil_reader';
    $password = 'webcodingfordummies';
    $database = 'logophil_webcodingfordummies';
 
    // Create a new MySQLi object with the database connection parameters
    $mysqli = new MySQLi($host, $user, $password, $database);
    
    // Check for a connection error
    if($mysqli->connect_error) {
        echo 'Connection Failed! 
              Error #' . $mysqli->connect_errno
                . ': ' . $mysqli->connect_error;
        exit(0);
    } else {
        echo 'So far, so good!';
    }
    
    $mysqli->set_charset('utf8');
    
    // That's it for now
    $mysqli->close();    
?>