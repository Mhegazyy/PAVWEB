<?php


require('../config/db_connect.php');
//If server request method is PUT


// Get the entry ID from the request parameters
$id = $_POST['id'];

// Connect to your database

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Update the 'opened' parameter for the corresponding entry
$sql = "UPDATE contact_messages SET opened = TRUE WHERE id = $id";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

// Close the database connection
$conn->close();



?>

