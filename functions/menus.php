<?php

function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'top-menu' => __( 'Top Menu' ),
      'top-menu-left' => __( 'Top Menu Left' ),
	  'top-menu-right' => __( 'Top Menu Right' ),
	  'footer-menu-1' => __( 'Footer Menu 1' ),
	  'footer-menu-2' => __( 'Footer Menu 2' )
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );

// menu icons
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
function my_wp_nav_menu_objects( $items, $args ) {
    
    // loop
    foreach( $items as $item ) {
		
        // vars
		$add_icon = get_field('add_icon', $item);

        $icon = get_field('image_icon', $item);
		echo $icon;
		//$icon_url = $icon['url'];
		$title = $item->post_title;
		$fa_icon = get_field('font_awesome_icon', $item);
        
        // append icon
		if ( $add_icon ) {
			
				if( $icon && ( $add_icon == 'image' ) ) {
					$item->title = '<div class="menu-icon-container"><img class="menu-icon" src="'. $icon_url .'" alt="'. $title .'" /></div><div>' . $title . '</div>';
				}
				elseif ( $fa_icon && ( $add_icon == 'fontawesome' ) ) {
					$item->title = '<div class="fa-icon-container">' . $fa_icon . '</div><div class="menu-item-title">' . $title . '</div>';
				}
			
		}
        
    }
    
    // return
    return $items;
    
}

add_action('wp_footer', 'header_footer_js');
function header_footer_js(){

    ?>
    <script>
    // sticky navigation
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
    stickyNav();
    </script>

    <script>
    // back to top button
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
    backToTopButton();
    </script>
    <?php
	
	$content_negative_margin = get_field('content_negative_margin', 'header');

	if ( $content_negative_margin === 'enabled' ) { ?>
		<script>
        function firstElementSpacing() {
            // add spacing to first page element

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
        firstElementSpacing();
        </script>

	<?php } ?>

<?php };