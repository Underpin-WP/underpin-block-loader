<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add this loader.
add_action( 'underpin/before_setup', function ( $file, $class ) {
		require_once( plugin_dir_path( __FILE__ ) . 'Blocks.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'Block.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'Block_Instance.php' );
		Underpin\underpin()->get( $file, $class )->loaders()->add( 'blocks', [
			'registry' => 'Underpin_Blocks\Loaders\Blocks',
		] );
}, 10, 2 );