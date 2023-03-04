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
    }
    
    $mysqli->set_charset('utf8');
    
    // Create and run a SELECT query
    $sql = 'SELECT category_name, description
                FROM categories';
    $result = $mysqli->query($sql);
    
    // Check for a query error
    if (!$result) {
        echo 'Query Failed! 
              Error: ' . $mysqli->error;
        exit(0);
        
    }

    // Get the query rows as an associative array
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    
    // Get the total number of rows
    $total_rows = count($rows);
    
    echo "Returned $total_rows categories:<br>";
    
    // Loop through the rows
    foreach($rows as $row) {
        echo $row['category_name'] . ': ' . $row['description'] . '<br>';
    }

    // That's it for now
    $mysqli->close();    
?>
