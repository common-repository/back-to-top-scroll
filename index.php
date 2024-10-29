<?php
/*
Plugin Name: Back to top scroll
Plugin URI: 
Version: 1.0
Author: Ganesh Paygude
Description: Add back to top button to scroll from bottom to top.
*/

/* Setup the plugin. */
add_action( 'plugins_loaded', 'btt_plugin_setup' );

/* Register plugin activation hook. */
register_activation_hook( __FILE__, 'btt_plugin_activation' );

/* Register plugin activation hook. */
register_deactivation_hook( __FILE__, 'btt_plugin_deactivation' );
/**
 * Do things on plugin activation.
 *
 */
function btt_plugin_activation() {
	/* Flush permalinks. */
    flush_rewrite_rules();
}
/**
 * Flush permalinks on plugin deactivation.
 */
function btt_plugin_deactivation() {
    flush_rewrite_rules();
}
function btt_plugin_setup() {
// create custom plugin settings menu
/* Get the plugin directory URI. */
	define( 'BACK_TO_TOP_LINK_PLUGIN_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	add_action('admin_menu', 'btt_plugin_create_menu');

}

function btt_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('Back To Top ', 'Back To Top Settings', 'administrator', __FILE__, 'btt_plugin_settings_page' , plugins_url('/images/link.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'btt_register_plugin_settings' );
}
function btt_wp_enqueue_scripts() {    
	
	wp_enqueue_script( 'btt-script-handle', BACK_TO_TOP_LINK_PLUGIN_URI . 'js/btt-script.js', array( 'jquery' ), 0.1, true );
	wp_enqueue_style( 'btt_stylesheet', BACK_TO_TOP_LINK_PLUGIN_URI. 'css/btt_style.css');
}
add_action( 'wp_head', 'btt_wp_enqueue_scripts' );

function btt_register_plugin_settings() {
	//register our settings	
	register_setting( 'btt-plugin-settings-group', 'btt_add_back_to_top' );
}

function btt_plugin_settings_page() {
?>
<div class="wrap">
<h2>Back to top scroll Settings:</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'btt-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'btt-plugin-settings-group' ); ?>
    <table class="form-table">
	<?php 	$btt_add_back_to_top = get_option( 'btt_add_back_to_top' );	?>	
	
	<tr valign="top">
        <th scope="row">Add back to top Button:</th>
        <td><input type='checkbox' id='btt_add_back_to_top' name='btt_add_back_to_top' value='1' <?php echo checked( $btt_add_back_to_top, 1, false );?> /></td>
        </tr>
			
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php }
$btt_add_back_to_top = get_option('btt_add_back_to_top');

if(checked( $btt_add_back_to_top, 1, false )){
	function btt_add_back_to_top_button(){ ?>
		<div class="back-to-top_wrapper">
		<a href="#" id="back-to-top"><img src="<?php echo BACK_TO_TOP_LINK_PLUGIN_URI; ?>images/btt-image.png" /></a>
		</div>
<?php	}
	add_filter('wp_footer', 'btt_add_back_to_top_button');
}
 ?>