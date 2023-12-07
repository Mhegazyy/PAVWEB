<?php 
require('../config/db_connect.php');
require_once('../config/session.php');

//Defining Variables
$id = $_SESSION['id'];
$q = "SELECT * FROM users WHERE id='$id'";
$res = mysqli_query($conn, $q);
$user = mysqli_fetch_assoc($res);
$user_name = $user['first_name'];

$contact_messages_query = "SELECT * FROM contact_messages ORDER BY id DESC";
$contact_messages_result = mysqli_query($conn, $contact_messages_query);

$application_forms_query = "SELECT * FROM Application_Forms ORDER BY id DESC";
$application_forms_result = mysqli_query($conn, $application_forms_query);
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css?v=3">
  <link href="https://fonts.cdnfonts.com/css/glober" rel="stylesheet">
  <script src="../scripts/javascript.js"></script>
  <title>Dashboard</title>
</head>
<body>
<?php include("../templates/header_nav.php") ?>
  <div class="reveal" id="content">
    <h2>Contact Messages</h2>
    <div class="table-container">
    <table id="contactTable">
        <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th id= "delete-cell">Delete</th>
      </tr>
      </thead>
      <tbody>
      <?php while ($row = mysqli_fetch_assoc($contact_messages_result)): ?>
        <tr>
         <td class = 'id'><?= $row['id']; ?></td>
          <td><?= $row['name']; ?></td>
          <td><?= $row['email']; ?></td>
          <td id=delete-cell>
          <button class="delete-contact-btn" contactId="<?= $row['id']; ?>">x</button>
        </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
      </div>

    <h2 id = "header-text">Application Forms</h2>
    <div class="table-container">
    <table id = "applicationTable">
      <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Position</th>
        <th id= "delete-cell">Delete</th>
      </tr>
      </thead>
      <tbody>
      <?php while ($row = mysqli_fetch_assoc($application_forms_result)): ?>
        <tr>
          <td class = "id"><?= $row['id']; ?></td>
          <td><?= $row['firstname']; ?></td>
          <td><?= $row['lastname']; ?></td>
          <td><?= $row['position']; ?></td>
          <td id="delete-cell">
          <button class="delete-application-btn" applicationId="<?= $row['id']; ?>">x</button>
      </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
      </table>
    </div>
      </div>


<!-- Application Forms Modal -->


      <div id="applicationModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Application Form Details</h2>
    <table>
    <tr>
  <td><strong>ID:</strong></td>
  <td><span id="applicationId"></span></td>
</tr>
<tr>
  <td><strong>First Name:</strong></td>
  <td><span id="applicationfName"></span></td>
</tr>
<tr>
  <td><strong>Last Name:</strong></td>
  <td><span id="applicationlName"></span></td>
</tr>
<tr>
  <td><strong>Email:</strong></td>
  <td><span id="applicationEmail"></span></td>
</tr>
<tr>
  <td><strong>Phone:</strong></td>
  <td><span id="applicationPhone"></span></td>
</tr>
<tr>
  <td><strong>Address:</strong></td>
  <td><span id="applicationAddress"></span></td>
</tr>
<tr>
  <td><strong>City:</strong></td>
  <td><span id="applicationCity"></span></td>
</tr>
<tr>
  <td><strong>State:</strong></td>
  <td><span id="applicationState"></span></td>
</tr>
<tr>
  <td><strong>Zip:</strong></td>
  <td><span id="applicationZip"></span></td>
</tr>
<tr>
  <td><strong>Position:</strong></td>
  <td><span id="applicationPosition"></span></td>
</tr>
<tr>
  <td><strong>About:</strong></td>
  <td><p id="applicationAbout"></p></td>
</tr>

    </table>
  </div>
</div>
<!-- Contact Messages Modal -->
      <div id="contactModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Contact Message Details</h2>
    <table>
      <tr>
        <td>ID:</td>
        <td><span id="contactId"></span></td>
      </tr>
      <tr>
        <td>Name:</td>
        <td><span id="contactName"></span></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><span id="contactEmail"></span></td>
      </tr>
      <tr>
        <td>Message:</td>
        <td><p id="contactMessage"></p></td>
      </tr>
    </table>
  </div>
</div>


<!-- Confirm Delete Modal -->
<div id="confirmDeleteModal" class="modal">
  <div class="modal-content" id="delete-modal">
    <h2>Are you sure you want to delete this item?</h2>
    <button id="confirmDeleteBtn" class = "modal-button">Delete</button>
    <button id="cancelDeleteBtn" class = "modal-button">Cancel</button>
  </div>
</div>
  <div id="footer">
    <p>&copy; 2023 Pavillion Architects. All rights reserved.</p>
  </div>
  <script src="../scripts/admin.js"></script>
</body>
</html>