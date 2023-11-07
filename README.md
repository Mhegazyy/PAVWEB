# Pavillion Architects Website

This website is hosted for the architectural consultancy company "Pavillion Architects".

## Website Overview
This website adopts a minimalistic modern design, for ease of use and accessibility. The style of the website is not cluttered and elements are visible and distinguishable. This website allows the user to contact the company, apply for a job position in the company, or learn more about the company. The website also allows the administrator to view all contact messages and the application forms submitted by the users. Overall, the website is very user friendly.


## Installation
This website requires and apache server and a mysql server to run. While developing the website, the application used for server hosting was [XAMPP](https://www.apachefriends.org/). After installing the program: 
1. Head to the directory which has your XAMPP folder. 
![Xampp](https://user-images.githubusercontent.com/114480051/234166450-27945dec-8f0a-4fba-ac58-ad230dadeee5.png)

2. Open the htdocs folder, and paste the "Pavillion_Website" folder inside.
![htdocs](https://user-images.githubusercontent.com/114480051/234166572-6bd2b21f-10b5-44e5-8505-2d31e90cf63b.png)

3. Open XAMPP and open the MYSQL admin page.
![phpmyadmin](https://user-images.githubusercontent.com/114480051/234723020-86c78eb4-234c-40ea-ba0a-e281b2cd40b0.png)



4. Create a new database called "pavillion" and import the pavillion.sql file inside it.
![Database](https://user-images.githubusercontent.com/114480051/234723276-53efd22f-327a-4f77-b148-7494b29a8a52.png)

5. You are now ready to use the website.

## Usage
### Running the website
1. Start your XAMPP control panel, and start the MySQL and Apache servers.![tempsnip](https://user-images.githubusercontent.com/114480051/234167205-4eac0e59-a1f1-4566-a1f5-633b5bcb37dc.png)


2. Open your browser, and type "localhost/Pavillion_Website/pages" in the URL.
![url](https://user-images.githubusercontent.com/114480051/234723861-1525cc77-cec4-4533-9438-eb5470e9111c.png)

### Website Usage
The functions of the website are simple and easy to use. In order to send a contact message to the company, navigate to the Contact Us page and fill out the form at the end of the page. You can also apply for a job in the company by going to the Apply For a Job page and submitting an application. However, you can only apply once every 2 days in order to avoid resubmissions and cluttering. The login page can only be used by the administrator to login and view the data recorded in the website, the administrator username and password are "admin" and "admin" for easy access and testing the functions of the website. When you login you will be navigated to the dashboard page which you can use to view any form entry, and delete the entries which you choose to. Keep in mind deleted entries are not restorable. The website also has an About Us page which contains info about the company owning the website.

## Frameworks and Languages Used
This website is built using basic HTML5, CSS, JavaScript, PHP, and MySQL. There were no frameworks used. The Font of the website was imported from a font service.
1. *HTML* and *CSS*:
The HTML and CSS languages were used in order to build the front-end elemenys of the website and style them accordingly. The style of the website is a very modern black and white theme, and it is complemented by a background of modern architecture resembling the overall direction of the company. The CSS is responsible for the animations of the website which give it a user-friendly flow and aesthetic. The smoothness of the website is caused by the strong implementations of transitions, assisted by JavaScript code to make the website interactive and functional.

2. *JavaScript*:
The JavaScript language was used in order to implement both front-end element transitions and back-end server communication. For the front end, the JavaScript was used to implement the reveal animations and the flip animations of the about us cards. It was also user to hide and reveal the modals of the dashboard page and to display the Thank you message of the Contact Us page. For the back end, there are many AJAX requests used throughout the page. The implementation of the AJAX requests was mainly due to the desire of not reloading the page each time a submission is done, as well as to be able to view the full information of the table entries in the dashboard page. It was also used to be able to check whether the entries were previously viewed or not, as well as allow the administrator to delete the entries if they wish to do so. All these functions needed to disable the page reload of the default POST method. An example of the usage is the following:

```javascript
xhr.onload = function() {
            console.log('Response received:', xhr.responseText);
            // Parse the response as JSON
            var response = JSON.parse(xhr.responseText);
        
            // Check if there are any errors
            if (response.hasOwnProperty('Name_Error') || response.hasOwnProperty('Email_Error') || response.hasOwnProperty('Message_Error')) {
                // Display the errors in the form fields
                if (response.hasOwnProperty('Name_Error')) {
                    document.querySelector('#name-error').textContent = response['Name_Error'];
                }
                if (response.hasOwnProperty('Email_Error')) {
                    document.querySelector('#email-error').textContent = response['Email_Error'];
                }
                if (response.hasOwnProperty('Message_Error')) {
                    document.querySelector('#message-error').textContent = response['Message_Error'];
                }
            } else {
                // No errors, form submitted successfully
                var contactContainer = document.querySelector('.contact-container');
                var thankYou = document.querySelector('#thank-you');
                document.getElementById('contact-form').style.display = 'none';
                document.querySelector('#contact-header').style.display = 'none';
                contactContainer.style.height = '100%';
                console.log('contactContainer height:', contactContainer.offsetHeight);

                setTimeout(function() {
                    thankYou.style.display = 'block';
                    contactContainer.style.textAlign = 'center';
                    setTimeout(function() {
                        //contactContainer.style.textAlign = 'center';
                        thankYou.style.animation = 'fadeIn 1s';
                    }, 5);
                }, 200);
        
                // Animate the transition
                setTimeout(function() {
                    contactContainer.style.transition = 'height 0.5s ease-in-out';
                    contactContainer.style.height = thankYou.offsetHeight + 'px';
                    console.log('contactContainer new height:', contactContainer.offsetHeight);

                }, 200);
            }
        };
        
//        xhr.onerror = function() {
//            console.log('There was an error submitting the form.');
//        };
        console.log(formData.get('name'), formData.get('email'), formData.get('message'));

        xhr.send(formData);
        
        });
    });
```


3. *PHP*:
The PHP language was used for the client-server communication throughout the whole website. The structure of the website allows for the use of PHP in many instances. Even as the AJAX requests run, the functionality of the requests is PHP based. The website implements server communication in many instances such as:
- Login functionality and Sessions
- Cookies for rejecting multiple applications
- Sending application forms and contact messages to the database
- Retrieving application and contact details in the dashboard page

This is an example of PHP code used in the website:
```php
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
```
4. *MYSQL*:
The SQL language was used inside the PHP in order to be able to communicate with the tables inside the database, and perform the CRUD operations. Most of the instances where PHP was used also employed the use of the MYSQL language.




## Changes In Mind
In the near future I would like to add the possibility of undoing a form submission or an entry deletion. I would also like to include more functions for the website such as an automatically updated list of the projects that the company is working on by accessing the project management database of the company. 

## Contact and Inquiries
If you would like to contact me or you have a suggestion for the website, please raise an issue in the repository and I will contact you as soon as I can!
