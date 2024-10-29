<?php 
/* Adding Latest jQuery from Wordpress */
function wp_nicescrollbar_latest_jquery() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('wp_nicescrollbar_jquery',plugins_url( '/js/nicescroll.min.js' , __FILE__ ),array( 'jquery' ));
}
add_action('init', 'wp_nicescrollbar_latest_jquery');

// adding script

function wp_nice_raju_admvacedscrollbar_hook() {

?>
<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery("html").niceScroll({
			cursorcolor:"<?php echo my_get_option( 'cursorcolor', 'wedevs_basics', '#35B137' );?>",
			cursorwidth:"<?php echo my_get_option( 'cursorwidth', 'wedevs_basics', '10px' );?>",
			cursorborderradius:"<?php echo my_get_option( 'cursorborderradius', 'wedevs_basics', '4px' );?>",
			autohidemode:<?php echo my_get_option( 'autohidemode', 'wedevs_basics', 'true' );?>,
			cursorborder:"<?php echo my_get_option( 'cursorborder', 'wedevs_advanced', '1px solid #fff' );?>",
			scrollspeed:"<?php echo my_get_option( 'scrollspeed', 'wedevs_advanced', '60' );?>",
			horizrailenabled:<?php echo my_get_option( 'horizrailenabled', 'wedevs_advanced', 'true' );?>,
			touchbehavior:<?php echo my_get_option( 'touchbehavior', 'wedevs_advanced', 'false' );?>,
			});
		});
	</script>
<?php
}
add_action('wp_head', 'wp_nice_raju_admvacedscrollbar_hook');