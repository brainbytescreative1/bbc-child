// sticky nav
function stickyNav() {
    // When the user scrolls the page, execute myFunction
    window.addEventListener('scroll', stickyNav);

    // Get the navbar
    var navbar = document.getElementById("sticky-nav");
    navbar.classList.add("d-none");
    navbar.classList.add("fixed-top");
    navbar.classList.add("animated");

    // calculate menu height
    let mainNav = document.querySelector('#wrapper-navbar');
    let mainNavHeight = mainNav.offsetHeight;
    let mainNavHeightOffset = mainNav.offsetHeight + 200;

    // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function stickyNav() {
        
        if (window.pageYOffset >= mainNavHeightOffset) {
            navbar.classList.add("slideDown");
            navbar.classList.add("d-block");
            navbar.classList.remove("slideUp");
            navbar.classList.remove("d-none");
        } else if ( window.pageYOffset <= mainNavHeight ) {
            navbar.classList.add("slideUp");
            navbar.classList.remove("d-block");
            navbar.classList.remove("slideDown");
        }
    }
}

// back to top button
function backToTopButton() {

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
        scrollFunction();
    };

    let mybutton = document.getElementById("btn-back-to-top");

    function scrollFunction() {

        //Get the button
        if ( mybutton ) {
            mybutton.style.display = "flex";
            //let mybutton = '<button type="button" class="btn-back-to-top" id="btn-back-to-top"><i class="fas fa-chevron-up"></i></button>';
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "flex";
            } else {
                mybutton.style.display = "none";
            }
        }

    }
    // When the user clicks on the button, scroll to the top of the document
    if ( mybutton ) {
        mybutton.addEventListener("click", backToTop);
    }

    function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
}

// add negative margin to page
function firstElementSpacing() {
    // add spacing to first page element

    // calculate menu height
    let menu = document.querySelector('#wrapper-navbar');
    let menuHeight = menu.offsetHeight + 1;

    // apply style to content
    // content wrapper
    let content = document.querySelector('.wrapper');
    content.style.marginTop = "-" + menuHeight + 'px';

    // get first element style
    let firstElement = document.querySelector('.entry-content .element-container:first-child');
    let firstElementStyle = getComputedStyle(firstElement);

    // set top padding of first element
    let paddingTop = parseInt(firstElementStyle.paddingTop);
    firstElement.style.setProperty("padding-top", ( menuHeight + paddingTop ) + 'px', "important");
}