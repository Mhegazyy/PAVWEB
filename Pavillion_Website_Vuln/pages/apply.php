<?php
// Connect to My Sql
require("../config/db_connect.php");

//Validation Layers

// Defining Vars
$firstname = $lastname = $email = $phone = $address = $city = $state = $zip = $position = $about = "";

$err_firstname = $err_lastname = $err_email = $err_phone = $err_address = $err_city = $err_state = $err_zip = $err_position = $err_about = "";

$valid_firstname = $valid_lastname = $valid_email = $valid_phone = $valid_address = $valid_city = $valid_state = $valid_zip = $valid_position = $valid_about = false;

if (isset($_POST['submit'])){
if (isset($_COOKIE["form_submitted"])) {
    header('location: alr_sub.php');
}else{
//============First Name=============
//=========Null Validation==========
    if (empty($_POST['first-name'])){
    $err_firstname = 'This field is required!';
    } else{
    $firstname = htmlspecialchars($_POST['first-name']);

    //============No Number==============
    if(strpbrk($firstname,"0123456789")){
        $err_firstname = 'No numbers are allowed in this field!';

    }else{
    $valid_firstname = true;
    }
    }
    //============Last Name=============
    //=========Null Validation==========
    if (empty($_POST['last-name'])){
        $err_lastname = 'This field is required!';
        } else{
        $lastname = htmlspecialchars($_POST['last-name']);
        //============No Number==============
        if(strpbrk($lastname,"0123456789")){
            $err_lastname = 'No numbers are allowed in this field!';
        
        }else{
        $valid_lastname = true;
        }

    }
    //============Email=============
    //=========Null Validation==========
    if (empty($_POST['email'])){
        $err_email = 'This field is required!';
    } else{
        $email = htmlspecialchars($_POST['email']);
        //============Email Format Validation==============
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $err_email = 'Invalid email format!';
        }else{
        //===========Email Uniqeness Validation=============
            $q = "SELECT * FROM Application_Forms WHERE email = '$email'";
            $result = mysqli_query($conn,$q);
            if( mysqli_num_rows($result) > 0) { 
                $err_email = 'E-mail Already Exists';
            }else{
                $valid_email = true;
            }
            
        }
    }
    // Phone Number Validation
    if (empty($_POST['phone'])) {
        $err_phone = 'This field is required!';
    } else {
        $phone = htmlspecialchars($_POST['phone']);
        // Regular expression pattern match for only numbers
        if (!preg_match('/^[0-9]+$/', $phone)) {
            $err_phone = 'Please enter a valid phone number!';
        } else {
            $q2 = "SELECT * FROM Application_Forms WHERE phone = '$phone'";
            $res = mysqli_query($conn,$q2);
            if(mysqli_num_rows($res) > 0){
                $err_phone = 'Phone Number Already Exists';
            }else{
                $valid_phone = true;
            }
            
        }
    }
    //============Address=============
    //=========Null Validation==========
    if (empty($_POST['address'])){
        $err_address = 'This field is required!';
    } else{
        $address = htmlspecialchars($_POST['address']);

        //============No Special Characters==============
        if(preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $address)){
            $err_address = 'Special characters are not allowed in this field!';

        }else{
            $valid_address = true;
        }

    }
    //============City=============
    //=========Null Validation==========
    if (empty($_POST['city'])){
        $err_city = 'This field is required!';
    } else{
        $city = htmlspecialchars($_POST['city']);
        
        //============No Number==============
        if (!preg_match("/^[a-zA-Z\s]+$/", $city)){
            $err_city = 'Only letters are allowed in this field!';
        } else{
            $valid_city = true;
        }
    }
    //============State=============
    //=========Null Validation==========
    if (empty($_POST['state'])){
        $err_state = 'This field is required!';
    } else{
        $state = htmlspecialchars($_POST['state']);
        //============Letters Only==============
        if (!preg_match("/^[a-zA-Z\s]+$/", $state)){
            $err_state = 'Only letters are allowed in this field!';
        } else{
            $valid_state = true;
        }
    }
    //============Zip Code=============
    //=========Null Validation==========
    if (empty($_POST['zip'])){
        $err_zip = 'This field is required!';
    } else{
        $zip = htmlspecialchars($_POST['zip']);
        //============Format Check==============
        if (!preg_match("/^\d{5}$/", $zip)) {
            $err_zip = 'Please enter a valid 5-digit zip code!';
        } else{
            $valid_zip = true;
        }
    }
    //============Position=============
    //=========Null Validation==========
    if (empty($_POST['position'])){
        $err_position = 'This field is required!';
    } else{
        $position = htmlspecialchars($_POST['position']);

        //===========Validating Position============
        if(!preg_match("/^[a-zA-Z ]*$/", $position)){
            $err_position = 'Only letters and white space allowed in this field!';
        }else{
            $valid_position = true;
        }
    }
    //============About=============
    //=========Null Validation==========
    if (empty($_POST['about'])){
        $err_about = 'This field is required!';
    } else{
        $about = htmlspecialchars($_POST['about']);
        //============Length Check==============
        if (strlen($about) < 50 || strlen($about) > 500){
            $err_about = 'Please enter between 50 and 500 characters.';
        } else{
            $valid_about = true;
        }
    }
    if ($valid_about && $valid_address && $valid_city && $valid_email && $valid_firstname && $valid_lastname && $valid_phone && $valid_position && $valid_state && $valid_zip && $valid_about && $valid_address) {
        $query = "INSERT INTO Application_Forms (firstname, lastname, email, phone, address, city, state, zip, position, text) VALUES ('$firstname', '$lastname', '$email', '$phone', '$address', '$city', '$state', '$zip', '$position', '$about')";
        if(mysqli_query($conn,$query)){
            setcookie("form_submitted", strval(time() + 60 * 60 * 24 * 2), time() + 60 * 60 * 24 * 2 , "/");
            header('location: thankyou.php');
        }else{
            echo "ERROR:" . mysqli_error($conn) . "<br>";
        }
    }
}
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
    <title>Apply</title>
</head>
<body>
<?php include("../templates/header_nav.php") ?>
    <div class="reveal" id="content">
        <div class="apply-container">
            <h2>Apply Now</h2>
            <form action="apply.php" method="post">
    <label class="revealform" for="first-name">First Name</label>
    <input class="revealform" type="text" id="first-name" name="first-name" value="<?php echo $firstname ?>">
    <div class="danger"><p><?php echo $err_firstname ?></p></div>

    <label class="revealform" for="last-name">Last Name</label>
    <input class="revealform" type="text" id="last-name" name="last-name" value="<?php echo $lastname ?>">
    <div class="danger"><p><?php echo $err_lastname ?></p></div>

    <label class="revealform" for="email">E-mail</label>
    <input class="revealform" type="email" id="email" name="email" value="<?php echo $email ?>">
    <div class="danger"><p><?php echo $err_email ?></p></div>

    <label class="revealform" for="phone">Phone Number</label>
    <input class="revealform" type="tel" id="phone" name="phone" value="<?php echo $phone ?>">
    <div class="danger"><p><?php echo $err_phone ?></p></div>

    <label class="revealform" for="address">Address</label>
    <input class="revealform" type="text" id="address" name="address" value="<?php echo $address ?>">
    <div class="danger"><p><?php echo $err_address ?></p></div>

    <label class="revealform" for="city">City</label>
    <input class="revealform" type="text" id="city" name="city" value="<?php echo $city ?>">
    <div class="danger"><p><?php echo $err_city ?></p></div>

    <label class="revealform" for="state">State/Province</label>
    <input class="revealform" type="text" id="state" name="state" value="<?php echo $state ?>">
    <div class="danger"><p><?php echo $err_state ?></p></div>

    <label class="revealform" for="zip">Zip/Postal Code</label>
    <input class="revealform" type="text" id="zip" name="zip" value="<?php echo $zip ?>">
    <div class="danger"><p><?php echo $err_zip ?></p></div>

    <label class="revealform" for="position">Position Applying To</label>
    <input class="revealform" type="text" id="position" name="position" value="<?php echo $position ?>">
    <div class="danger"><p><?php echo $err_position ?></p></div>

    <label class="revealform" for="about">Tell us about yourself</label>
    <textarea class="revealform" id="about" name="about"><?php echo $about ?></textarea>
    <div class="danger"><p><?php echo $err_about ?></p></div>

    <button class="revealform" type="submit" name="submit">Submit</button>
</form>

    </div>
</div>
<div id="footer">
    <p>&copy; 2023 Pavillion Architects. All rights reserved.</p>
    </div>
</body>
</html>