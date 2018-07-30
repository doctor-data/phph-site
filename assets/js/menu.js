document.addEventListener("DOMContentLoaded", function () {
    function toggleClassMenu(e) {
        if (e.srcElement.id === 'nav-button') {
            e.preventDefault();
        }
        myMenu.classList.add("menu--animatable");
        if (!myMenu.classList.contains("menu--visible")) {
            myMenu.classList.add("menu--visible");
        } else {
            myMenu.classList.remove('menu--visible');
        }
    }

    function OnTransitionEnd() {
        myMenu.classList.remove("menu--animatable");
    }

    var myMenu = document.querySelector(".menu");
    var oppMenu = document.querySelector(".nav-button");
    myMenu.addEventListener("transitionend", OnTransitionEnd, false);
    oppMenu.addEventListener("click", toggleClassMenu, false);
    myMenu.addEventListener("click", toggleClassMenu, false);
});