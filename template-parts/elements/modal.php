<?php

if( get_row_layout() == 'modal' ):
    
    // ids
    $modal_id = 'modal-' . rand(0,9999);
    $video_id = 'video-' . rand(0,9999);
    $trigger_id = 'trigger' . strval(rand(0,9999));

    // heading
    $heading = get_sub_field('heading');
    $heading_element = null;
    if ( $heading ) {

        $heading_text = $heading['text'];

        if ( $heading_text ) {

            $heading_tag = $heading['tag'];
            $heading_color = $heading['theme_colors'];
            $heading_size = $heading['font_size'];

            $heading_element = '<'. $heading_tag . ' class="modal-title" id="exampleModalLabel">'. $heading_text . '</'. $heading_tag . '>';

        }
        
    }

    // trigger
    $trigger = get_sub_field('trigger');
    if ( $trigger && ( $trigger == 'icon' ) ) {

        $icon = get_sub_field('icon');

        $icon_classes = [];
        $icon_classes[] = 'modal-trigger-icon';

        // style
        $icon_size = get_sub_field('icon_size');
        if ( $icon_size ) {
            $icon_classes[] = $icon_size;
        }

        $icon_color = get_sub_field('icon_color');
        if ( $icon_color['theme_colors'] ) {
            $icon_classes[] = 'text-' . $icon_color['theme_colors'];
        }

        $icon_classes = esc_attr( trim( implode(' ', $icon_classes ) ) );
        
        echo '<a type="button" data-bs-toggle="modal" id="'. $trigger_id .'" data-bs-target="#'. esc_attr( trim( $modal_id ) ) .'" class="'. $icon_classes .'">'. $icon .'</a>'; // trigger icon
    }

    // settings
    $close_button = get_sub_field('close_button');
    
    // content
    $body_content = get_sub_field('body_content');
    if ( $body_content == 'youtube' ) {

        $youtube_video_original = get_sub_field('youtube_video');

        if ( $youtube_video_original ) {

            $youtube_video_id = null;
            $youtube_video = $youtube_video_original;
            $youtube_video = str_replace('https://', '', $youtube_video_original);
            $youtube_video = str_replace('http://', '', $youtube_video);
            $youtube_video = str_replace('youtube.com', '', $youtube_video);
            $youtube_video = str_replace('youtu.be', '', $youtube_video);
            $youtube_video = str_replace('embed', '', $youtube_video);

            $youtube_video_id = trim(str_replace('/', '', $youtube_video));

            $youtube_video_src = 'https://www.youtube.com/embed/'. $youtube_video_id .'?autoplay=1';

        }
        
    }
    
    ?>

    <div class="modal fade<?php if ( $heading_element ) { echo ' has-header'; } ?>" id="<?=esc_attr( trim( $modal_id ) )?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <?php if ( $heading_element ) {
                        echo $heading_element;
                    } ?>

                    <?php if ( $close_button && ( $close_button == 'top') ) { ?>
                        <button type="button" class="btn-close<?php if ( !$heading_element ) { echo ' btn-close-white'; } ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                    <?php } ?>
                    
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe src="" type="text/html" id="<?=esc_attr( trim( $video_id ) )?>"></iframe>
                        
                        <script>
                            const trigger<?=$trigger_id?> = document.getElementById("<?=$trigger_id?>");
                            const rows<?=$trigger_id?> = document.getElementsByClassName("row");

                            trigger<?=$trigger_id?>.onclick = function(){modalTrigger<?=$trigger_id?>()};

                            function modalTrigger<?=$trigger_id?>() {
                                
                                
                            }
                        </script>
                        <script>
                            var myModalEl = document.getElementById('<?=$modal_id?>')
                            myModalEl.addEventListener('show.bs.modal', function (event) {
                                for(var index=0;index < rows<?=$trigger_id?>.length;index++){
                                    rows<?=$trigger_id?>[1].style.setProperty('z-index', '1053', 'important');
                                    document.getElementById("<?=$video_id?>").src="<?=$youtube_video_src?>";
                                }
                            });
                            myModalEl.addEventListener('hidden.bs.modal', function (event) {
                                for(var index=0;index < rows<?=$trigger_id?>.length;index++){
                                    rows<?=$trigger_id?>[1].style.setProperty('z-index', '1', 'important');
                                    document.getElementById("<?=$video_id?>").src=null;
                                }
                            });
                        </script>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    
    
endif;