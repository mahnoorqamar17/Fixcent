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
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone_number, product_service, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone_number, $product_service, $message);
    
    // Set parameters and execute
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['subject'];
    $product_service = $_POST['product_service'];
    $message = $_POST['message'];
    
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        // Successful insert
        echo "Your message has been sent. Thank you!";
    } else {
        // Error or no rows inserted
        echo "Error: " . $stmt->error;
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
