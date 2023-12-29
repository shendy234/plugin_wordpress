<?php 
/**
 * @package  KeamananPlugin
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = array();

	public $subpages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Keamanan Plugin', 
				'menu_title' => 'Keamanan', 
				'capability' => 'manage_options', 
				'menu_slug' => 'Keamanan_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-dashboard', 
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'Keamanan_plugin', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'Siem', 
				'capability' => 'manage_options', 
				'menu_slug' => 'Keamanan_Siem', 
				'callback' => array( $this->callbacks, 'adminSiem' )
			),
			array(
				'parent_slug' => 'Keamanan_plugin', 
				'page_title' => 'Custom Waf', 
				'menu_title' => 'Waf', 
				'capability' => 'manage_options', 
				'menu_slug' => 'Keamanan_Waf', 
				'callback' => array( $this->callbacks, 'adminWaf' )
			)
		);
	}
}