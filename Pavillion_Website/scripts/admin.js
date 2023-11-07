
document.addEventListener('DOMContentLoaded', function () {
    initializeDashboard();
});

function initializeDashboard() {
  // Get the modal and close button
  const contactModal = document.getElementById("contactModal");
  const applicationModal = document.getElementById("applicationModal")
  const contactCloseButton = contactModal.querySelector(".close");
  const applicationCloseButton = applicationModal.querySelector(".close");

//Contact Modal Script
  function fetchContactData(id, callback) {
    const xhr = new XMLHttpRequest(); // Define xhr variable inside fetchContactData function
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        //console.log(xhr.responseText);
        callback(data);
      }
    };
    xhr.open('GET', '../functions/get_contact_message.php?id=' + encodeURIComponent(id), true);
    xhr.send();
  }

  // Function to display the contact message modal
  function showContactModal(id, name, email, message, opened) {
    console.log('showContactModal triggered');
    document.getElementById("contactId").textContent = id;
    document.getElementById("contactName").textContent = name;
    document.getElementById("contactEmail").textContent = email;
    document.getElementById("contactMessage").textContent = message;

    // Add an AJAX call to update the 'opened' parameter in the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../functions/update_contact_message.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            //console.log(this.responseText);
        }
    }
    xhr.send("id=" + id + "&opened=true");

    setTimeout(function() {
        contactModal.classList.add("fade-in");
    }, 10);

    contactModal.style.display = "block";
}

  

  // Close the modal when the close button is clicked
  contactCloseButton.onclick = function () {
    contactModal.classList.add("fade-out");
    contactModal.classList.remove("fade-in");
    setTimeout(function() {
      contactModal.style.display = "none";
      contactModal.classList.remove("fade-out");
    }, 300);
  };

  // Close the modal when clicking outside the modal content
  window.addEventListener('click', function (event) {
    if (event.target === contactModal) {
      contactModal.classList.add("fade-out");
      contactModal.classList.remove("fade-in");
      setTimeout(function() {
        contactModal.style.display = "none";
        contactModal.classList.remove("fade-out");
      }, 300);
    }
  });

  // Add click event listeners for each table row
  const contactRows = document.querySelectorAll('#contactTable tbody tr');
contactRows.forEach(function (row) {
  const cells = row.getElementsByTagName('td');
  if (cells.length > 1 && cells[0] && cells[1]) {
    const id = cells[0].textContent;
    fetchContactData(id, function (data) {
      if (data.error) {
        console.error('Error:', data.error);
      } else {
        if (data.opened) {
          row.classList.add('opened');
        }
        row.addEventListener('click', function () {
          const email = data.email;
          const name = data.name;
          const message = data.message;
          showContactModal(id, name, email, message);
          row.classList.add('opened');
        });
      }
    });
  }
});





  // ===============Application Modal Script===================



  function fetchApplicationData(id, callback) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        console.log(xhr.responseText);
        callback(data);
      }
    };
    xhr.open('GET', '../functions/get_application_form.php?id=' + encodeURIComponent(id), true);
    xhr.send();
  }

  // Function to display the application message modal
  function showApplicationModal(id, fName, lName, email, phone, address, city, state, zip, position, about) {
    console.log('showApplicationModal triggered');
    document.getElementById("applicationId").textContent = id;
    document.getElementById("applicationfName").textContent = fName;
    document.getElementById("applicationlName").textContent = lName;
    document.getElementById("applicationEmail").textContent = email;
    document.getElementById("applicationPhone").textContent = phone;
    document.getElementById("applicationAddress").textContent = address;
    document.getElementById("applicationCity").textContent = city;
    document.getElementById("applicationState").textContent = state;
    document.getElementById("applicationZip").textContent = zip;
    document.getElementById("applicationPosition").textContent = position;
    document.getElementById("applicationAbout").textContent = about;
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_application_form.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            //console.log(this.responseText);
        }
    }
    xhr.send("id=" + id + "&opened=true");

  
    setTimeout(function() {
      applicationModal.classList.add("fade-in");
    }, 10);
    applicationModal.style.display = "block";
  }

  // Close the modal when the close button is clicked
  applicationCloseButton.onclick = function () {
    applicationModal.classList.add("fade-out");
    applicationModal.classList.remove("fade-in");
    setTimeout(function() {
      applicationModal.style.display = "none";
      applicationModal.classList.remove("fade-out");
    }, 300);
  };
  // Close the modal when pressing outside the window
  window.onclick = function (event) {
    if (event.target === applicationModal) {
      applicationModal.classList.add("fade-out");
      applicationModal.classList.remove("fade-in");
      setTimeout(function() {
        applicationModal.style.display = "none";
        applicationModal.classList.remove("fade-out");
      }, 300);
    }
  };

  // Add click event listeners for each table row
  const applicationRows = document.querySelectorAll('#applicationTable tbody tr');
  applicationRows.forEach(function (row) {
    const cells = row.getElementsByTagName('td');
    if (cells.length > 1 && cells[0] && cells[1]) {
      const id = cells[0].textContent;
      fetchApplicationData(id, function (data) {
        if (data.error) {
          console.error('Error:', data.error);
        } else {
          if (data.opened) {
            row.classList.add('opened');
          }
          row.addEventListener('click', function () {
            const email = data.email;
            const fName = data.fName
            const lName = data.lName
            const phone = data.phone;
            const address = data.address;
            const city = data.city;
            const state = data.state;
            const zip = data.zip;
            const position = data.position
            const about = data.about
            showApplicationModal(id, fName, lName, email, phone, address, city, state, zip, position, about);
            row.classList.add('opened');
          });
        }
      });
    }
  });

  function deleteContact(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../functions/delete_contact_entry.php?id=' + encodeURIComponent(id), true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.success) {
          // Hide the confirmation modal
          const confirmDeleteModal = document.getElementById('confirmDeleteModal');
          confirmDeleteModal.classList.add('fade-out');
          confirmDeleteModal.classList.remove('fade-in');
          setTimeout(function() {  
            confirmDeleteModal.classList.remove('fade-out');
            confirmDeleteModal.style.display = 'none';
            }, 500);
          // Contact deleted successfully, remove the row from the table
          const contactRow = document.querySelector('#contactTable tbody button[contactId="' + id + '"]').closest('tr');

          if (contactRow) {
            contactRow.remove();
          }


        } else {
          console.error('Error:', response.error);
        }
      } else {
        console.error('Error:', xhr.statusText);
      }
    };
    xhr.send();
  }
  
  function cancelDelete() {
    // Hide the confirmation modal
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.classList.add('fade-out');
    confirmDeleteModal.classList.remove('fade-in');
    setTimeout(function() {  
      confirmDeleteModal.classList.remove('fade-out');
      confirmDeleteModal.style.display = 'none';
      }, 500);
  
    // Re-add the event listener for the contact modal
    const contactButtons = document.querySelectorAll('.contact-btn');
    contactButtons.forEach(function (button) {
      button.addEventListener('click', showContactModal);
    });
  
    // Remove event listeners for the confirmation and cancel buttons
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    confirmDeleteBtn.removeEventListener('click', deleteContact);
    cancelDeleteBtn.removeEventListener('click', cancelDelete);
  }
  
  const deleteContactButtons = document.querySelectorAll('.delete-contact-btn');
  deleteContactButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
      event.stopPropagation();
      const row = button.closest('tr');
      const id = row.querySelector('.id').textContent;
      const confirmDeleteModal = document.getElementById('confirmDeleteModal');
      const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
      const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
  
      // Remove the event listener for the contact modal
      const contactButtons = document.querySelectorAll('.contact-btn');
      contactButtons.forEach(function (button) {
        button.removeEventListener('click', showContactModal);
      });
  
      // Show the confirmation modal
      setTimeout(function() {  
      confirmDeleteModal.classList.add('fade-in');
      }, 500);
  
      // Set the ID of the row to be deleted as a data attribute on the confirmation button
      confirmDeleteBtn.setAttribute('data-id', id);
  
      // Add event listeners to the confirmation and cancel buttons
      confirmDeleteBtn.addEventListener('click', () => deleteContact(id));
      cancelDeleteBtn.addEventListener('click', cancelDelete);
    });
  });
  function deleteApplication(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../functions/delete_application_entry.php?id=' + encodeURIComponent(id), true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.success) {
          // Hide the confirmation modal
          const confirmDeleteModal = document.getElementById('confirmDeleteModal');
          confirmDeleteModal.classList.add('fade-out');
          confirmDeleteModal.classList.remove('fade-in');
          setTimeout(function() {  
            confirmDeleteModal.classList.remove('fade-out');
            confirmDeleteModal.style.display = 'none';
          }, 500);
          // Application deleted successfully, remove the row from the table
          const applicationRow = document.querySelector('#applicationTable tbody button[applicationId="' + id + '"]').closest('tr');
          console.log(applicationRow);
  
          if (applicationRow) {
            applicationRow.remove();
          }
        } else {
          console.error('Error:', response.error);
        }
      } else {
        console.error('Error:', xhr.statusText);
      }
    };
    xhr.send();
  }
  const deleteApplicationButtons = document.querySelectorAll('.delete-application-btn');
  deleteApplicationButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
      event.stopPropagation();
      const row = button.closest('tr');
      console.log(row);
      const id = row.querySelector('.id').textContent;
      const confirmDeleteModal = document.getElementById('confirmDeleteModal');
      const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
      const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
  
      // Remove the event listener for the application modal
      const applicationButtons = document.querySelectorAll('.application-btn');
      applicationButtons.forEach(function (button) {
        button.removeEventListener('click', showApplicationModal);
      });
  
      // Show the confirmation modal
      setTimeout(function() {  
        confirmDeleteModal.classList.add('fade-in');
      }, 500);
  
      // Set the ID of the row to be deleted as a data attribute on the confirmation button
      confirmDeleteBtn.setAttribute('data-id', id);
  
      // Add event listeners to the confirmation and cancel buttons
      confirmDeleteBtn.addEventListener('click', () => deleteApplication(id));
      cancelDeleteBtn.addEventListener('click', cancelDelete);
    });
  });
   
}

