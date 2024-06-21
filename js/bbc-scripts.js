//header("Content-Type: application/javascript");

function updateVideoBgURL(videoUrl) {
    let video = '';
    const screen_width = window.innerWidth;
    if ( screen_width >= 768 ) {
        video = '<source src="'+ videoUrl +'" type="video/mp4" />';
        video = document.writeln(video);
        return video;
    } else {
        return null;
    }
};
function isMobile(desktopUrl, mobileUrl) {
    let result = '';

    const screen_width = window.innerWidth;

    if ( screen_width <= 768 ) {
        result = mobileUrl;
    } else {
        result = desktopUrl;
    }

    result = document.writeln(result);
    return result;
};

function isMobileSize(size) {
    const screen_width = window.innerWidth;
    if ( screen_width <= 768 ) {
        size = 'medium_large';
    }
    //size = document.writeln(size);
    return size;
};

function backToTopButton() {
    //Get the button
	let mybutton = document.getElementById("btn-back-to-top");

	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function () {
	scrollFunction();
	};

	function scrollFunction() {
	if (
		document.body.scrollTop > 20 ||
		document.documentElement.scrollTop > 20
	) {
		mybutton.style.display = "flex";
	} else {
		mybutton.style.display = "none";
	}
	}
	// When the user clicks on the button, scroll to the top of the document
	mybutton.addEventListener("click", backToTop);

	function backToTop() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
	}
}

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

function firstElementSpacing() {
    // calculate menu height
    let menu = document.querySelector('#wrapper-navbar');
    let menuHeight = menu.offsetHeight;

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