<?php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Database connection parameters
    $servername = "localhost"; // Change this if your MySQL server is on a different host
    $username = "root"; // MySQL username (default is 'root' in most installations)
    $password = ""; // MySQL password (default is blank in XAMPP/WAMP)
    $dbname = "fixcentdummy"; // Name of your database
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    
    // Set parameters and execute
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        // Successful insert
        echo "Message sent successfully!";
    } else {
        // Error or no rows inserted
        if ($stmt->error) {
            echo "Error: " . $stmt->error;
        } else {
            echo "Error: Failed to insert message";
        }
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If accessed directly, redirect back to the form page or handle appropriately
    header("Location: index.html"); // Replace with your form page
    exit();
}

?>
