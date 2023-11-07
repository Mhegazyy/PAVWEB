document.addEventListener('DOMContentLoaded', function() {

    document.querySelector('#contact-form').addEventListener('submit', function (event) {
        event.preventDefault();
        console.log('Form submitted');
        var formData = new FormData(document.querySelector('#contact-form'));
        console.log('Form data:', formData);
    
        // Send the form data to the PHP script using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../functions/submit-contact-form.php');
        //xhr.setRequestHeader('Content-Type', 'multipart/form-data');
    
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
        
        
