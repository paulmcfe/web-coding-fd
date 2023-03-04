<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Products</title>
    <style>
        .align-left {
            text-align: left;
        }
        
        .align-right {
            text-align: right;
            width: 75px;
        }
    </style>
</head>
<body>

<?php
    // Parse the query string
    if (isset($_GET['category'])) {
        $category_num = $_GET['category'];
    } else {
        echo 'The "category" parameter is missing!<br>';
        echo 'We are done here, sorry.';
        exit(0);
    }
    
    // Make sure the category value is an integer between 1 and 8
    // See Book 7, Chapter 3 to learn about the powerful filter_var() function
    $category_num = filter_var($category_num, 
                               FILTER_VALIDATE_INT, 
                               array("options" => array("min_range" => 1, "max_range" => 8)));

    if (!$category_num) {
        echo 'Yo, the "category" value must be an integer from 1 to 8!<br>';
        echo 'Please try again.';
        exit(0);        
    }

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
    // This is an INNER JOIN of the products and categories tables,
    // based on the category_id value that was in the query string
    $sql = "SELECT products.product_name, 
                   products.unit_price, 
                   products.units_in_stock, 
                   categories.category_name
                FROM products
                INNER JOIN categories
                ON products.category_id = categories.category_id
                WHERE products.category_id = $category_num";
    $result = $mysqli->query($sql);
    
    // Check for a query error
    if (!$result) {
        echo 'Query Failed! 
              Error: ' . $mysqli->error;
        exit(0);
        
    }

    // Get the query rows as an associative array
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    
    // Get the category name
    $category = $rows[0]['category_name'];
    
    echo "<h2>$category</h2>";
    echo '<table>';
    echo '<tr>';
    echo '<th class="align-left">Product</th>';
    echo '<th class="align-right">Price</th>';
    echo '<th class="align-right">In Stock</th>';
    echo '</tr>';
    
    // Loop through the rows
    foreach($rows as $row) {
        echo '<tr>';
        echo '<td>' . $row['product_name']. '</td>
              <td class="align-right">' . $row['unit_price'] . '</td>
              <td class="align-right">' . $row['units_in_stock'] . '</td>';
        echo '</tr>';   
    }
    echo '</table>';

    // That's it for now
    $mysqli->close();    
?>

</body>
</html>
