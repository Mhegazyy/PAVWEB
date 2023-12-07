<?php
include('../config/db_connect.php');
$id = $_GET['id'];

// Delete the contact with the given ID from the database
$delete_contact_query = "DELETE FROM contact_messages WHERE id = $id";
mysqli_query($conn, $delete_contact_query);

$response = array('success' => true);
echo json_encode($response);

?>