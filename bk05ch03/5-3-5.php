<?php

    // Store the database connection parameters
    $host = 'localhost';
    $user = 'logophil_reader';
    $password = 'webcodingfordummiess';
    $database = 'logophil_webcodingfordummies';
 
    // Create a new MySQLi object with the database connection parameters
    $mysqli = new MySQLi($host, $user, $password, $database);
    
    // Check for a connection error
    if($mysqli->connect_error) {
        echo 'Connection Failed! 
              Error #' . $mysqli->connect_errno
                . ': ' . $mysqli->connect_error;
        exit(0);
    }
    
    // Create and run a SELECT query
    // This is an INNER JOIN of the products and categories tables,
    // based on the category_id value that was in the query string
    $sql = "INSERT
            INTO categories (category_name, description)
            VALUES ('Breads', 'Multi-grain, rye, and other deliciousness')";
    $result = $mysqli->query($sql);
    
    // Check for a query error
    if (!$result) {
        echo 'Query Failed! 
              Error: ' . $mysqli->error;
        exit(0);    
    } else {
        echo "Success!";
    }

?>

