document.addEventListener("DOMContentLoaded", function () {
    function toggleClassMenu(e) {
        if (e.target.id === 'nav-button') {
            e.preventDefault();
        }
        myMenu.classList.add("menu--animatable");
        if (!myMenu.classList.contains("menu--visible")) {
            myMenu.classList.add("menu--visible");
            body.classList.add("nav--active");
        } else {
            myMenu.classList.remove('menu--visible');
            body.classList.remove("nav--active");
        }
    }

    function OnTransitionEnd() {
        myMenu.classList.remove("menu--animatable");
    }

    var myMenu = document.querySelector(".menu");
    var oppMenu = document.querySelector(".nav-button");
    var body = document.querySelector("body");
    myMenu.addEventListener("transitionend", OnTransitionEnd, false);
    oppMenu.addEventListener("click", toggleClassMenu, false);
    myMenu.addEventListener("click", toggleClassMenu, false);
});