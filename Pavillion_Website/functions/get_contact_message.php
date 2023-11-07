<?php
require('../config/db_connect.php');
ini_set('display_errors', 1);
header('Content-Type: application/json');

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  try {
    $query = "SELECT * FROM contact_messages WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
      echo json_encode([
        'id' => $row['id'],
        'name' => $row['name'],
        'email' => $row['email'],
        'message' => $row['message'],
        'opened' => $row['opened']
      ]);
    } else {
      echo json_encode(['error' => 'No data found']);
    }
  } catch (Exception $e) {
    echo json_encode(['error' => 'Error retrieving data']);
  }
}

?>
