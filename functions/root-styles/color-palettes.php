<?php

// Set the default color palette for certain fields
function set_acf_color_picker_default_palettes() {
	
	$primary = get_field('primary', 'style');
	$secondary = get_field('secondary', 'style');
	$success = get_field('success', 'style');
    $info = get_field('info', 'style');
    $danger = get_field('danger', 'style');
    $warning = get_field('warning', 'style');
	$text = get_field('text', 'style');
	$light = get_field('light', 'style');
	$dark = get_field('dark', 'style');
    $gray = get_field('gray', 'style');
	$white = get_field('white', 'style');
	
    ?>
    <script>
    let setDefaultPalette = function() {
        acf.add_filter('color_picker_args', function( args, $field ){

            // Find the field key
            let targetFieldKey = $field[0]['dataset']['key'];

            // Set color options for the field
            if ( 'field_6557b927ac428' === targetFieldKey ) {
                args.palettes = [ 
                    '<?php echo $primary; ?>',
                    '<?php echo $secondary; ?>',
                    '<?php echo $success; ?>',
                    '<?php echo $info; ?>',
                    '<?php echo $danger; ?>',
                    '<?php echo $warning; ?>',
                    '<?php echo $text; ?>',
                    '<?php echo $light; ?>',
                    '<?php echo $dark; ?>',
                    '<?php echo $gray; ?>',
                    '<?php echo $white; ?>' 
                ];
            }

            // Return
            return args;
        });
    }
    setDefaultPalette();
    </script>
    <?php
    }
add_action('acf/input/admin_footer', 'set_acf_color_picker_default_palettes');