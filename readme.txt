=== PC Custom CSS ===

Contributors: petercoughlin
Donate link: http://petercoughlin.com/donate/
Tags: custom css, custom, css
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: trunk

Enables custom CSS code to be easily used with any theme.

== Description ==

This plugin provides an easy and effective way to to use your own custom CSS code with any theme.

Just enter your custom CSS code on the plugin settings page under the Appearance -> Custom CSS menu.

== Installation ==

1. Unzip the download file if necessary and upload the `pc-custom-css` folder and all its contents to your `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in your WordPress admin.
3. Click on the 'Custom CSS' menu under the Appearance menu in your WordPress admin.
4. Add your custom CSS to the plugin settings page.
5. Click the Save Changes button.

== Changelog ==

= 1.3 =
* Added custom body class.
* Added uninstall.php to remove plugin settings.

= 1.2 =
* Replaced the physical CSS file with a dynamically generated one.
* Added timestamp parameter to custom CSS file.

= 1.1 =
* Added code to rewrite custom.css file after plugin automatic updates.

= 1.0 =
* Initial version.

== Upgrade Notice ==

The plugin previously removed its settings on deactivation. This caused problems for poeple who wanted to deativate the plugin but not lose any settings. The plugin now removes settings only on deletion.

You can now add a custom CSS class to the body tag.

