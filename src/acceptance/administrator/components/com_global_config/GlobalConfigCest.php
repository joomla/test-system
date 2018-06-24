<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace administrator\components\com_global_config;
use Page\Acceptance\Administrator\GlobalConfiguration as GlobalConf;
use Step\Acceptance\Site\FrontEnd as FrontEnd;

/**
 * Global Configuration class
 *
 * @category  Menu_Article
 * @package   Administratorcomponentscom_Menu_Article
 * @author    Samarth sharma <samarthsharma351@gmail.com>
 * @copyright 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license   Joomla 2005-2018
 * @link      ArticleMenuCest
 * @since     __DEPLOYED_VERSION
 */
class GlobalConfigCest
{
	/**
	 * Site Offline
	 *
	 * @param   \AcceptanceTester   $I  Acceptance Tester
	 *
	 * @return void
	 */
	public function siteOffline(\AcceptanceTester $I)
	{
		$I->setSiteOffline();
	}
	/**
	 * Site Online
	 *
	 * @param   \AcceptanceTester   $I  Acceptance Tester
	 *
	 * @return void
	 */
	public function siteOnline(\AcceptanceTester $I)
	{
		$I->setSiteOnline();
	}
	/**
	 * Search Engine Optimization
	 *
	 * @param   \AcceptanceTester   $I  Acceptance Tester
	 *
	 * @return void
	 */
	public function siteSeoYes(\AcceptanceTester $I)
	{
		$I->setSiteSeoYes();
	}
	/**
	 * Search Engine Optimization
	 *
	 * @param   \AcceptanceTester   $I  Acceptance Tester
	 *
	 * @return void
	 */
	public function siteSeoNo(\AcceptanceTester $I)
	{
		$I->setSiteSeoNo();
	}



}
