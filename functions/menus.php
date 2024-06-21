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

// make dropdown menus open on hover
//add_action('wp_head', 'nav_submenu_fix');
function nav_submenu_fix(){ ?>

	<style>
		.dropdown:hover .dropdown-menu{
			display: block;
		}
		.dropdown-menu{
			margin-top: 0;
		}
	</style>
	<script>
	$(document).ready(function(){
		$(".dropdown").hover(function(){
			var dropdownMenu = $(this).children(".dropdown-menu");
			if(dropdownMenu.is(":visible")){
				dropdownMenu.parent().toggleClass("open");
			}
		});
	});     
	</script>
	
	<script>
	$(document).ready(function () {
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  }
	  var $subMenu = $(this).next(".dropdown-menu");
	  $subMenu.toggleClass('show');
	
	
	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		$('.dropdown-submenu .show').removeClass("show");
	  });
	
	  return false;
	});
	});
	
	</script>

<?php }

add_action('wp_footer', 'first_element_spacing_js');
function first_element_spacing_js(){

    ?>
    <script>stickyNav();</script>
    <?php
	
	$content_negative_margin = get_field('content_negative_margin', 'header');

	if ( $content_negative_margin === 'enabled' ) { ?>

		<!-- add spacing to first page element -->
		<script>firstElementSpacing();</script>

	<?php } ?>

<?php };