<?php

session_start();
if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
}
include('../functions/submit-contact-form.php')

?>
<link rel="stylesheet" href="style.css">
<html>
  <head>
    <title>Pavillion Architects</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src ="../scripts/javascript.js"></script>
    <link href="https://fonts.cdnfonts.com/css/glober" rel="stylesheet">
  </head>
  <body>
  <?php include("../templates/header_nav.php") ?>
      <div class = "reveal" id="content">
          <h2>Contact Us</h2>
          <div class="contact-info-container reveal">
            <div>
              <p><strong>Address:</strong><br>10 ElEzai Salah Zaki<br>Masaken Sheraton,Cairo<br>Egypt</p>
              <p><strong>Email:</strong><br>info@pavillionarchitects.com</p>
              <p><strong>Phone:</strong><br>+20 0226326493</p>
            </div>
          </div>          <div class="map-container reveal">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13807.244846734851!2d31.379021!3d30.0995927!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145815dcc3e4e599%3A0xc13091367d1af2a3!2zUGF2aWxsaW9uIEFyY2hpdGVjdHMgUy5BLkUg2KjYp9mB2YrZhNmK2YjZhiDYp9ix2YPZitiq2YPYqtiz!5e0!3m2!1sen!2seg!4v1679757425832!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        
        <div class="contact-container reveal">
        <h2 id = "contact-header">Send Us a Message</h2>
        <form id = "contact-form" method = 'post' action="contact.php">
        <div>
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="">
    <span class="danger" id="name-error"></span>
</div>

<div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="">
    <span class="danger" id="email-error"></span>
</div>

<div>
    <label for="message">Message</label>
    <textarea id="message" name="message"></textarea>
    <span class="danger" id="message-error"></span>
</div>

          
          <button type="submit" name = "send">Send</button>
          <!-- <div class = "danger"><p><?php echo $errors['Name_Error'] ?></p></div> -->
        </form>
        <div id='thank-you' style='display:none'>
        <h2>Thank you for your message!</h2>
        <?php unset($_SESSION['errors']); ?>
    </div>
      </div>
    </div>
    
      <script src = "../scripts/contact.js"></script>
      <div id="footer">
        <p>&copy; 2023 Pavillion Architects. All rights reserved.</p>
      </div>
    </body>
  </html>
  
    