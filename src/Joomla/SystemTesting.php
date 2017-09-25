<?php

namespace Joomla;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

/**
 * Class SystemTesting
 * @package Joomla
 *
 * @since   __DEPLOY_VERSION__
 */
class SystemTesting
{
	/**
	 * Set up the Joomla System Testing
	 *
	 * @param   Event  $event  Event
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function setup(Event $event)
	{
		// TODO Get it out of composer
		$rootDirectory = getcwd();

		copy(dirname(__DIR__) . '/acceptance.suite.dist.yml' , $rootDirectory);
		copy(dirname(__DIR__) . '/RoboFile.dist.ini' , $rootDirectory);
	}
}
