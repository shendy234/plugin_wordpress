<?php 
/**
 * @package  KeamananPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	public function adminSiem()
	{
		return require_once( "$this->plugin_path/templates/Siem.php" );
	}

	public function adminWaf()
	{
		return require_once( "$this->plugin_path/templates/Waf.php" );
	}

}