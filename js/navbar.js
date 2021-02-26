window.onload = function() {
    document.querySelector(".main h1").classList.add("active");
}
window.onscroll = function() {
    if (document.body.scrollTop > 10) {
        document.querySelector("header").style.boxShadow = "0px 0px 3px gray";
    } else if (document.body.scrollTop < 10) {
        document.querySelector("header").style.boxShadow = "none";
    }
}