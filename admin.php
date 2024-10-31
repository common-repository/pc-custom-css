<?php
class pc_custom_css_admin {
	function __construct() {
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
	}
	function admin_menu() {
		global $pc_custom_css;
		$pluginpage = add_theme_page( $pc_custom_css->name . ' Settings', $pc_custom_css->shortname, 'manage_options', $pc_custom_css->slug, array( &$this, 'settings_page' ) );
		add_filter( 'plugin_action_links_' . $pc_custom_css->basename, array( &$this, 'settings_link' ) );
	}
	function settings_link( $links ) {
		global $pc_custom_css;
		$links[] = '<a href="' . admin_url( 'admin.php?page=' . $pc_custom_css->slug ) . '">' . __( 'Settings' ) . '</a>';
		return $links;
	}
	function admin_plugin_scripts() {
		global $pc_custom_css;
		echo '<link rel="stylesheet" href="' . $pc_custom_css->url . 'css/admin.css" type="text/css" />' . "\n";
	}
	function settings_page() {
		global $pc_custom_css;
		$options = $pc_custom_css->get_options();
		
		if ( isset( $_POST['save-changes'] ) ) {
			if ( function_exists( 'current_user_can' ) && !current_user_can( 'manage_options' ) )
				die( 'Sorry, not allowed...' );
			check_admin_referer( 'pc_custom_css_settings' );
			$options['custom_body_class'] = trim( $_POST['custom_body_class'] );
			$options['custom_css'] = $_POST['custom_css'];
			$options['css_last_saved_time'] = time();
			update_option( 'pc_custom_css', $options );
			$msg .= '<p><strong>Settings saved.</strong></p>';
			echo '<div id="message" class="updated fade">' . $msg . '</div>';
		}
		echo '<div class="wrap">';
		screen_icon( 'options-general' );
		echo '<h2>' . $pc_custom_css->name . ' Settings - version ' . $pc_custom_css->version . '</h2>
		<form method="post">';
		if ( function_exists( 'wp_nonce_field' ) )
			wp_nonce_field( 'pc_custom_css_settings' );
		echo '<p>This plugin provides an easy and effective way to to use your own custom CSS code with any theme. Optionally, you can add a custom CSS class to your <code>&lt;body&gt;</code> tag.</p>
		<p><label for="custom_body_class">Custom body class (optional):</label><br /><input type="text" name="custom_body_class" id="custom_body_class" value="' . stripslashes( $options['custom_body_class'] ) . '" class="regular-text" /></p>
		<p><label for="custom_css">Custom CSS:</label><br /><textarea name="custom_css" id="custom_css" class="large-text" rows="20" style="font-family:Consolas,Monaco,monospace;">' . stripslashes( $options['custom_css'] ) . '</textarea></p>
		<p class="submit"><input type="submit" name="save-changes" class="button-primary" value="Save Changes" /></p>
		</form>
		</div>';
	}
}
$pc_custom_css_admin = new pc_custom_css_admin;
