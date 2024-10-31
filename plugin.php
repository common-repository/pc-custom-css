<?php
/*
Plugin Name: PC Custom CSS
Plugin URI: http://petercoughlin.com/
Description: Enables the use of custom CSS code with any theme.
Version: 1.3
Author: Peter Coughlin
Author URI: http://petercoughlin.com/
License: GPLv2 or later
*/

/*
Copyright 2011 Peter Coughlin http://petercoughlin.com
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class pc_custom_css {
	var $name = 'PC Custom CSS';
	var $shortname = 'Custom CSS';
	var $version = '1.3';
	var $url;
	var $dir;
	var $basename;
	var $slug;
	function __construct() {
		$this->url = plugin_dir_url( __FILE__ );
		$this->dir = str_replace( '\\', '/', plugin_dir_path( __FILE__ ) );
		$this->basename = plugin_basename( __FILE__ );
		$this->slug = str_replace( array( basename( __FILE__ ), '/' ), '', $this->basename );
		add_action( 'wp_head', array( &$this, 'wp_head' ), 11 );
		add_filter( 'query_vars', array( &$this, 'query_vars' ) );
		add_action( 'template_redirect', array( &$this, 'template_redirect' ) );
		add_filter( 'body_class', array( &$this, 'custom_body_class' ) );
	}
	function wp_head() {
		$options = $this->get_options();
		if ( !$options['css_last_saved_time'] )
			$options['css_last_saved_time'] = time();
		echo '<link rel="stylesheet" type="text/css" media="screen" href="' . $this->url . 'custom.css?pc_custom_css_ver=' . $options['css_last_saved_time'] . '" />' . "\n";
	}
	function query_vars( $vars ) {
		$vars[] = 'pc_custom_css_ver';
		return $vars;
	}
	function template_redirect() {
		if ( get_query_var( 'pc_custom_css_ver' ) ) {
			$options = $this->get_options();
			header( "HTTP/1.1 200 OK" );
			header( "Content-type: text/css" );
			echo stripslashes( $options['custom_css'] );
			exit;
		}
	}
	function custom_body_class( $classes ) {
		$options = $this->get_options();
		if ( $options['custom_body_class'] )
			$classes[] = $options['custom_body_class'];
		return $classes;
	}
	function get_options() {
		$options = get_option( 'pc_custom_css' );
		if ( !is_array( $options ) )
			$options = $this->set_defaults();
		return $options;
	}
	function set_defaults() {
		$options = array(
			'custom_css' => "/*-- Enter your custom CSS below --*/\n",
			'css_last_saved_time' => time()
			);
		update_option( 'pc_custom_css', $options );
		return $options;
	}
}
$pc_custom_css = new pc_custom_css;

if ( is_admin() )
	include_once dirname( __FILE__ ) . '/admin.php';
