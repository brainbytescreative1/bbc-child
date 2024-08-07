<?php

function get_social_icons_bbc( $social_icons ) {

    if ( $social_icons ) {

        // start content
        ob_start();

        $icon_list = $social_icons['icon_list'];

        echo '<ul class="social-icons-menu">'; // start social icons

        if ( $icon_list ) {
            
            foreach( $icon_list as $icon ) {

                // initialize classes arrays
                $icon_classes = [];
                $icon_styles = [];
                $text_classes = [];

                // get icon fields
                $link = $icon['link'];
                $separator = $icon['separator'];
                $text_content = $icon['text_content'];

                // add classes
                $icon_classes[] = 'icon';
                $icon_classes[] = 'lead';

                /*
                if ( $separator !== 'none' ) {
                    $icon_styles[] = 'border-' . $separator . ': 1px solid ' . $icon_color['theme_colors'];
                }
                */

                // process arrays
                $icon_classes = esc_attr( trim( implode(' ', $icon_classes ) ) );
                $icon_styles = esc_attr( trim( implode(' ', $icon_styles ) ) );
                $text_classes = esc_attr( trim( implode(' ', $text_classes ) ) );

                if ( $link ) {

                    $list_item_classes = [];

                    $value = $link['value'];
                    $title = $link['title'];
                    $target = $link['target'];

                    $list_item_classes = esc_attr( trim( implode(' ', $list_item_classes ) ) );

                    ?>
                    <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                        <a href="<?=$value?>" title="<?=$title?>" target="<?=$target?>">
                            <span class="<?=$icon_classes?>">
                                <i class="<?=$icon['icon']?>" aria-hidden="true"></i>
                            </span>
                        </a>
                    </li>
                    <?php
                } elseif ( $text_content ) { ?>

                    <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                        <span class="<?=$icon_classes?>">
                            <i class="<?=$icon['icon']?>" aria-hidden="true"></i>
                        </span>
                    </li>
                    
                <?php } else { ?>

                    <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                        <span class="<?=$icon_classes?>">
                            <i class="<?=$icon['icon']?>" aria-hidden="true"></i>
                        </span>
                    </li>

                <?php }

            }

        }

        echo '</ul>'; // end social icons

        // return content
        return ob_get_clean();

    }
}

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
        $post_title = $item->title;

        // image icon
        $image_icon_url = null;
        $image_icon = get_field('image_icon', $item);
        if ( isset( $image_icon['url'] ) ) {
            if ( $image_icon['url'] ) {
                $image_icon_url = $image_icon['url'];
            }
            
        }
		
		// font awesome icon
        $fa_icon = get_field('font_awesome_icon', $item);
        
        // append icon
		if ( $add_icon ) {
			
				if( $image_icon && ( $add_icon === 'image' ) ) {
					$item->title = '<div class="menu-icon-container"><img class="menu-icon" src="'. $image_icon_url .'" alt="'. $post_title .'" /></div><div>' . $post_title . '</div>';
				} elseif ( $fa_icon && ( $add_icon === 'fontawesome' ) ) {
                    $item->title = '<div class="fa-icon-container">' . $fa_icon . '</div><div class="menu-item-title">' . $post_title . '</div>';

				}
			
		}
        
    }
    
    // return
    return $items;
    
}

add_action('wp_footer', 'header_footer_js');
function header_footer_js(){

    ?>
    <script>stickyNav();</script>
    <script>backToTopButton();</script>
    
    <?php
	$content_negative_margin = get_field('content_negative_margin', 'header');
    $header_height = get_field('header_height', 'header');
	if ( $content_negative_margin === 'enabled' ) { ?>
		<script>firstElementSpacing(<?=$header_height?>);</script>
	<?php } 
    ?>

<?php };

// populate button forms
function my_acf_load_field( $field ) {

    $menus = [];
    
    $menus_list = wp_get_nav_menus();
    foreach ($menus_list as $menu) {
        $term_id = $menu->term_id;
        $name = $menu->name;
        $menus[] = [ $term_id, $name ];
    }

    $choices = [];

    // if enabled and exist
    foreach ($menus as $menu) {
        $choices += array( $menu[0] => __(ucfirst($menu[1]), 'bbc') );
    } 
	
	$field['choices'] = $choices;
	$field['default_value'] = null;
	return $field;

}
add_filter('acf/load_field/name=single_menu_select', 'my_acf_load_field');
add_filter('acf/load_field/name=left_menu_select', 'my_acf_load_field');
add_filter('acf/load_field/name=right_menu_select', 'my_acf_load_field');

function get_menu_bbc( $menu_id ) {
    if ( $menu_id ) {
        ob_start();
        wp_nav_menu( array(
            'menu' => $menu_id,
            'container' => 'div',
            'container_class' => 'acf-nav-menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        ) );
        return ob_get_clean();
    } else {
        return '';
    }
}