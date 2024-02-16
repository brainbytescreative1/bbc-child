<?php

if( get_row_layout() == 'form' ):

    // get fields
    $form = get_sub_field('form');

    if ( $form ) {
        echo do_shortcode('[gravityform id="'. $form .'" title="false" description="false" ajax="true"]');
    }

endif;