document.addEventListener('DOMContentLoaded', function() {
//     var i=0,text;
// text =  "We Work \nWith You\nFor You"



// function typing() {
//     if (i<text.length){
//         document.getElementById("hometext").innerHTML += text.charAt(i);
//         i++;
//         setTimeout(typing,50);
//     }
// }
// window.addEventListener('load',typing)
window.addEventListener('scroll', reveal);
window.addEventListener('scroll', revealform);
window.addEventListener('load', reveal);
window.addEventListener('load', revealform);
// window.addEventListener('load', function(){
//     if ('scrollRestoration' in history) {
//         history.scrollRestoration = 'manual';
//       }
// });
// document.querySelector('#contact-form').addEventListener('submit', function (event) {
//     // Prevent the default form submission
//     event.preventDefault();

//     // Hide the form
//     document.querySelector('#contact-form').style.display = 'none';

//     // Show the thank you message
//     document.querySelector('#thank-you').style.display = 'block';
// });
function reveal(){
    var reveals = document.querySelectorAll('.reveal');

    for (var i = 0; i < reveals.length; i++){

        var windowheight = window.innerHeight;
        var revealtop = reveals[i].getBoundingClientRect().top;
        var revealpoint = 150;

        if(revealtop < windowheight - revealpoint){
            reveals[i].classList.add('active')
        }
        else{
            reveals[i].classList.remove('active')
        }

    }
}
function revealform(){
    var reveals = document.querySelectorAll('.revealform');

    for (var i = 0; i < reveals.length; i++){

        var windowheight = window.innerHeight;
        var revealtop = reveals[i].getBoundingClientRect().top;
        var revealpoint = 20;

        if(revealtop < windowheight - revealpoint){
            reveals[i].classList.add('active')
        }
        else{
            reveals[i].classList.remove('active')
        }

    }
}

reveal();
// typing();
  });
  

