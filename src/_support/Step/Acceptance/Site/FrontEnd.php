<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Step\Acceptance\Site;

use Page\Acceptance\Site\FrontPage as FrontPage;

/**
 * Acceptance Step object class contains suits for Front End.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class FrontEnd extends \AcceptanceTester
{
	/**
	 * Check whether Item is not Visible on front end
	 *
	 * @param   \AcceptanceTester $I             The Acceptance Tester
	 * @param   string            $menuItemName  Menu Item Name
	 *
	 * @return void
	 */
	public static function notVisible(\AcceptanceTester $I, $menuItemName)
	{
		$I->comment('Make sure the menu item is not on site After unpublishing it');
		$I->amOnPage(FrontPage::$url);
		$I->dontSee($menuItemName);
	}
	/**
	 * Check whether Item is Visible on front end
	 *
	 * @param   \AcceptanceTester $I            Acceptance Tester
	 * @param   string            $menuItemName Menu Item Name
	 *
	 * @return void
	 */
	public static function isVisible(\AcceptanceTester $I, $menuItemName)
	{
		$I->comment('Check the menu item on site After publishing it');
		$I->amOnPage(FrontPage::$url);
		$I->see($menuItemName);
	}
	/**
	 * Check whether article is not Visible on front end
	 *
	 * @param   \AcceptanceTester $I             The Acceptance Tester
	 * @param   string            $menuItemName  Menu Item Name
	 * @param   string            $articleName   Article Name
	 *
	 * @return void
	 */
	public static function articleIsVisible(\AcceptanceTester $I, $menuItemName, $articleName)
	{
		$I->comment('Check the menu item on site After publishing it');
		$I->amOnPage(FrontPage::$url);
		$I->see($menuItemName);
		$I->click(['link' => $menuItemName]);
		$I->see($articleName);
	}
	/**
	 * Check whether article is not Visible on front end
	 *
	 * @param   \AcceptanceTester $I             The Acceptance Tester
	 * @param   string            $menuItemName  Menu Item Name
	 * @param   string            $articleName   Article Name
	 *
	 * @return void
	 */
	public static function articleIsNotVisible(\AcceptanceTester $I, $menuItemName, $articleName)
	{
		$I->comment('Check the menu item on site After publishing it');
		$I->amOnPage(FrontPage::$url);
		$I->see($menuItemName);
		$I->click(['link' => $menuItemName]);
		$I->dontSee($articleName);
	}

	public static function siteOffline(\AcceptanceTester $I)
	{
		$I->amOnPage(FrontPage::$url);
		$I->see('This site is down for maintenance');
	}

	public static function siteOnline(\AcceptanceTester $I)
	{
		$I->amOnPage(FrontPage::$url);
		$I->doFrontEndLogin('admin','admin');
		$I->dontSee('This site is down for maintenance');
	}

	public static function seoCheckYes(\AcceptanceTester $I)
	{
		$I->amOnPage(FrontPage::$url);
		$I->click(['link' => 'Home']);
		$I->seeInCurrentUrl('/index.php?catid%5B0%5D=');
	}

	public static function seoCheckNo(\AcceptanceTester $I)
	{
		$I->amOnPage(FrontPage::$url);
		$I->doFrontEndLogin('admin','admin');
		$I->click(['link' => 'Home']);
		$I->seeInTitle('Home - Joomla CMS test');
	}
}