<?php
/**
 * Block Factory
 *
 * @since   1.0.0
 * @package Underpin\Abstracts
 */


namespace Underpin_Blocks\Factories;


use Underpin\Traits\Instance_Setter;
use Underpin_Blocks\Abstracts\Block;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Admin_Bar_Menu
 * Handles creating custom admin bar menus
 *
 * @since   1.0.0
 * @package Underpin\Abstracts
 */
class Block_Instance extends Block {
	use Instance_Setter;

	/**
	 * Block_Instance constructor.
	 *
	 * @param array $args Overrides to default args in the object
	 */
	public function __construct( array $args = [] ) {
		$this->set_values( $args );

		parent::__construct();
	}

}