/*=============Go To Top Button Click Event=====================*/
window.onscroll = function() { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        document.getElementById("nav-container").style.transition = "0.5s ease";
        document.getElementById("myBtn").style.display = "block";
        document.getElementById("nav-container").style.padding = "15px 1.5em";
    } else {
        document.getElementById("nav-container").style.transition = "0.5s ease";
        document.getElementById("myBtn").style.display = "none";
        document.getElementById("nav-container").style.padding = "25px 1.5em";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

/*======Javacript For Opening & Closing Cars Details============*/
var coll = document.getElementsByClassName("collapsible");
var i;
for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    });
}
/*======Open and Close SideBar============*/
function openBar() {
    document.getElementById("sidebar").style.transform = "translateY(0px)";
    document.getElementById("sidebar").style.transition = "0.5s ease";
}

function closeBar() {
    document.getElementById("sidebar").style.transform = "translateY(-100%)";
    document.getElementById("sidebar").style.transition = "0.5s ease";
}