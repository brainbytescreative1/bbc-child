<?php

//add_action('wp_footer', 'add_class_to_buttons');
function add_class_to_buttons(){ ?>

	<?php
		$button_border = get_field('button_border', 'style');
	?>
	
	<script>
		window.onload = function() {
			var buttons = document.getElementsByClassName("btn"),
				len = buttons !== null ? buttons.length : 0,
				i = 0;
			for(i; i < len; i++) {
				buttons[i].className += " btn-<?php echo $button_border; ?>"; 
			}
		}
	</script>
	
<?php }