<?php
/**
 * Blocks
 *
 * @since   1.0.0
 * @package Underpin\Registries\Loaders
 */


namespace Underpin_Blocks\Loaders;

use Underpin\Abstracts\Registries\Object_Registry;
use Underpin_Blocks\Abstracts\Block;
use WP_Error;
use function Underpin\underpin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Blocks
 * Registry for Cron Jobs
 *
 * @since   1.0.0
 * @package Underpin\Registries\Loaders
 */
class Blocks extends Object_Registry {

	/**
	 * @inheritDoc
	 */
	protected $abstraction_class = 'Underpin_Blocks\Abstracts\Block';

	protected $default_factory = 'Underpin_Blocks\Factories\Block_Instance';

	/**
	 * @inheritDoc
	 */
	protected function set_default_items() {}

	/**
	 * @inheritDoc
	 */
	public function do_actions() {
		add_action( 'init', [ $this, 'register' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles_and_scripts' ] );
	}

	/**
	 * Prepares the script. Generally used to localize last-minute params without overriding the enqueue method.
	 *
	 * @since 1.0.0
	 */
	public function prepare_script() {
		$script = underpin()->scripts()->get( $this->script );
		$script->set_param( 'nonce', wp_create_nonce( 'wp_rest' ) );
		$script->set_param( 'rest_url', get_rest_url() );
	}

	/**
	 * Enqueues admin styles and scripts.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles_and_scripts() {
		if ( ! is_wp_error( underpin()->scripts()->get( $this->script ) ) ) {
			$this->prepare_script();
			underpin()->scripts()->get( $this->script )->enqueue();
		}

		$style = underpin()->styles()->get( $this->style );

		if ( ! is_wp_error( $style ) ) {
			$style->enqueue();
		}
	}

	/**
	 * @param string $key
	 *
	 * @return Block|WP_Error Script Resulting block class, if it exists. WP_Error, otherwise.
	 */
	public function get( $key ) {
		return parent::get( $key );
	}

}