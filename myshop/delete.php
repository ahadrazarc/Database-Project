<?php
ob_start(); // Start output buffering

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $username = "localhost";
    $servername = "root";
    $password = "";
    $database = "myshop";

    // Create connection
    $connection = new mysqli($username, $servername, $password, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM clients WHERE id=?";
    $stmt = $connection->prepare($sql);

    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the statement
        $stmt->execute();

        // Check for errors
        if ($stmt->error) {
            echo "Error: " . $stmt->error;
        } else {
            // Display message dialog box using JavaScript
            echo "<script>alert('Record deleted successfully.'); window.location.href='index.php';</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $connection->error;
    }

    // Close the connection
    $connection->close();

    ob_end_flush(); // Flush the output buffer
    exit(); // Make sure that no other code is executed after the redirect
}
?>
