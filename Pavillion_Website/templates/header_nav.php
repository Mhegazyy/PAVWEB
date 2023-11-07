<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);

function get_nav_link($link, $text) {
    global $current_page;
    if ($link === $current_page) {
        return "<a href='#'>$text</a>";
    } else {
        return "<a href='$link'>$text</a>";
    }
}
?>

<div id="header">
    <tr>
        <td><img src="../assets/pav_logo.png" alt="Pavillion Logo" width="120px" height="120px"></td>
        <td><h1>Pavillion Architects</h1></td>
    </tr>
</div>

<div id="navbar">
    <?php echo get_nav_link('index.php', 'Home'); ?>
    
    <?php if(isset($_SESSION['id'])) {
        echo get_nav_link('dashboard.php', 'Dashboard');
    } else {
        echo get_nav_link('apply.php', 'Apply For A Job');
    } ?>
    <?php echo get_nav_link('about.php', 'About Us'); ?>
    <?php echo get_nav_link('contact.php', 'Contact Us'); ?>
    <?php if(isset($_SESSION['id'])) {
        echo get_nav_link('../functions/logout.php', 'Logout');
    } else {
        echo get_nav_link('login.php', 'Login');
    } ?>
</div>
