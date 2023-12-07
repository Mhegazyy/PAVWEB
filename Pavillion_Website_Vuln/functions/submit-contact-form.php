<?php
require('../config/db_connect.php');
// Check if the form was submitted
// var_dump($_POST);
// die();

$err_name = $err_email = $err_message = '';
$errors = array();

//echo ( $_SERVER["REQUEST_METHOD"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    // Get the form data
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $message = isset($_POST['message']) ? $_POST['message'] : "";

    // var_dump($name);
    // var_dump($email);
    // var_dump($message);
    

    // Validate the form data
    
    if (empty($name)) {
        $errors['Name_Error'] = "Name is required";
        $err_name = "This field is required!";
    }
    if (empty($email)) {
        $errors['Email_Error'] = "Email is required";
        $err_email = "This field is required!";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email_Error'] = "Invalid email format";
        $err_email = "Invalid email format";
        
    }
    if (empty($message)) {
        $errors['Message_Error'] = "Message is required";
        $err_message = "This field is required!";
    }
    $_SESSION['errors'] = $errors;
    // If there are no errors, save the form data to the database
    if (empty($errors)) {
        // Connect to the databas

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute the SQL statement
        if ($stmt->execute()) {
            echo json_encode("Form submitted successfully");
        } else {
            error_log("Error: " . $stmt->error);
            echo "Error submitting form. Please try again later.";
        }

        // Close the database connection
        $stmt->close();
        mysqli_close($conn);

    } else {
        // If there are errors, send them back to the client
        header("HTTP/1.1 400 Bad Request");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($errors);
    }
}
?>
