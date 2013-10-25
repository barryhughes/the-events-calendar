<?php

/**
 * Class TribeEventsImporter_Plugin
 */
class TribeEventsImporter_Plugin {
	private static $plugin_basename = '';
	/** @var TribeEventsImporter_AdminPage */
	private static $admin = NULL;

	public static function path( $path ) {
		$base = dirname(dirname(__FILE__));
		$path = $base . DIRECTORY_SEPARATOR . $path;
		return untrailingslashit($path);
	}

	public static function set_plugin_basename( $basename ) {
		self::$plugin_basename = $basename;
	}

	public static function init_textdomain() {
		load_plugin_textdomain( 'tribe-events-importer', FALSE, dirname( self::$plugin_basename ) . '/lang/' );
	}

	public static function add_plugin_row_meta_links( $links, $file ) {
		if ( $file == self::$plugin_basename ) {
			$anchor = __( 'Support', 'tribe-events-importer' );
			$links [] = '<a href="http://tri.be/support/?ref=importer-addon">' . $anchor . '</a>';
			$anchor = __( 'View All Add-Ons', 'tribe-events-importer' );
			$links [] = '<a href="http://tri.be/shop/?ref=importer-addon">' . $anchor . '</a>';
		}
		return $links;
	}

	public static function initialize_admin() {
		self::$admin = new TribeEventsImporter_AdminPage();
		add_action( 'admin_menu', array( self::$admin, 'register_admin_page' ) );
		add_action( 'load-tribe_events_page_events-importer', array( self::$admin, 'handle_submission' ) );
	}

	public static function get_admin_object() {
		return self::$admin;
	}
}
