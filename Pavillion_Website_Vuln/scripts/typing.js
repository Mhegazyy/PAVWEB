document.addEventListener('DOMContentLoaded', function() {
    var i=0,text;
text =  "We Work \nWith You\nFor You"



function typing() {
    if (i<text.length){
        document.getElementById("hometext").innerHTML += text.charAt(i);
        i++;
        setTimeout(typing,50);
    }
}
window.addEventListener('load',typing) 
});