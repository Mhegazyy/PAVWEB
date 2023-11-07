<?php
// Name of the cookie
$cookie_name = "form_submitted";

// Check if the cookie is set
// var_dump($_COOKIE[$cookie_name]);
if(isset($_COOKIE[$cookie_name])) {
    // Retrieve the expiration time from the cookie
    $expiration_time = $_COOKIE[$cookie_name];

    // Calculate the time remaining until expiration
    $time_remaining = intval($expiration_time) - time();

    // Convert seconds to days, hours, minutes, and seconds
    $days_remaining = floor($time_remaining / (24 * 60 * 60));
    $hours_remaining = floor(($time_remaining % (24 * 60 * 60)) / (60 * 60));
    $minutes_remaining = floor(($time_remaining % (60 * 60)) / 60);
    $seconds_remaining = $time_remaining % 60;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.cdnfonts.com/css/glober" rel="stylesheet">
    <script src ="../scripts/javascript.js"></script>
    <title>Already Applied!</title>
</head>
<body>
<?php include("../templates/header_nav.php") ?>
    <div class="reveal" id="about">
        <h2>Whoops</h2>
        <br>
        <h2>Looks like you have already applied to our company, you will need to wait before you can try again, but don't worry, we will contact you as soon as possible! </h2>
        <br>
        <h2>Time Remaining:</h2>
        <br>
        <h2><?php echo $days_remaining ?> days <?php echo $hours_remaining ?> hours <?php echo $minutes_remaining ?> minutes <?php echo $seconds_remaining ?> seconds</h2>
      </div>
</div>
<div id="footer">
    <p>&copy; 2023 Pavillion Architects. All rights reserved.</p>
    </div>
</body>
</html>