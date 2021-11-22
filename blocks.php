<?php

use Underpin\Abstracts\Underpin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add this loader.
Underpin::attach( 'setup', new \Underpin\Factories\Observer( 'blocks', [
	'update' => function ( Underpin $plugin ) {
		require_once( plugin_dir_path( __FILE__ ) . 'lib/loaders/Blocks.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'lib/abstracts/Block.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'lib/factories/Block_Instance.php' );
		$plugin->loaders()->add( 'blocks', [
			'class' => 'Underpin_Blocks\Loaders\Blocks',
		] );
	},
] ) );
