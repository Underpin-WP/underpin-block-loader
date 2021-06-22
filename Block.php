<?php
/**
 * WordPress Block Abstraction
 *
 * @since   1.0.0
 * @package Lib\Core\Abstracts
 */


namespace Underpin_Blocks\Abstracts;

use Underpin\Traits\Feature_Extension;
use function Underpin\underpin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Block
 * WordPress Block Class
 *
 * @since   1.0.0
 * @package Lib\Core\Abstracts
 */
abstract class Block {
	use Feature_Extension;

	/**
	 * The registered block.
	 *
	 * @since 1.0.0
	 *
	 * @var bool
	 */
	public $type = false;

	/**
	 * Args to pass when registering the block.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $args = [];

	/**
	 * Block constructor.
	 */
	public function __construct() {

		if ( false === $this->type ) {
			underpin()->logger()->log(
				'error',
				'invalid_block_type',
				'The provided block does not appear to have a type set',
				[ 'class' => get_class( $this ), 'type' => $this->type, 'expects' => 'string' ]
			);
		}
	}

	/**
	 * @inheritDoc
	 */
	public function do_actions() {
		add_action( 'init', [ $this, 'register' ] );
	}

	/**
	 * Registers the block type.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		$registered = register_block_type( $this->type, $this->args );
		if ( false === $registered ) {
			underpin()->logger()->log(
				'error',
				'block_not_registered',
				'The provided block failed to register. Register block type provides a __doing_it_wrong warning explaining more.',
				[ 'ref' => $this->type, 'expects' => 'string' ]
			);
		} else {
			underpin()->logger()->log(
				'notice',
				'block_registered',
				'The provided block was registered successfully.',
				[ 'ref' => $this->type, 'args' => $this->args ]
			);
		}
	}
	public function __get( $key ) {
		if ( isset( $this->$key ) ) {
			return $this->$key;
		} else {
			return new \WP_Error( 'block_param_not_set', 'The key ' . $key . ' could not be found.' );
		}
	}

}