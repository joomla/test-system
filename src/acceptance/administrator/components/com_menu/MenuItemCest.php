<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2018 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace menuItemCest;
use Step\Acceptance\Administrator\MenuItem as MenuItemStep;
use Page\Acceptance\Administrator;
use Step\Acceptance\Administrator\MenuItem;


/**
 * Menu Item class
 *
 * @category  Menu_Article
 * @package   Administratorcomponentscom_Menu_Article
 * @author    Samarth sharma <samarthsharma351@gmail.com>
 * @copyright 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license   Joomla 2005-2018
 * @link      ArticleMenuCest
 * @since     __DEPLOYED_VERSION
 */
class MenuItemCest
{
	/**
	 * Variables Initialised
	 *
	 * menuItemTitle	string
	 * menuItemAlias	string
	 */
	public function __construct()
	{
		$this->menuItemName = 'Menu Item Test 911';
		$this->menuItemAlias = 'MenuAliasTest 911';
	}
	/**
	 * Creates a menu item with the Joomla menu manager
	 *
	 * @param   \AcceptanceTester $I The Acceptance Tester
	 *
	 * @throws \Exception
	 * @since  3.0.0
	 * @return void
	 */
	public function menuItem(\AcceptanceTester $I)
	{
		/**
		 * Initializing values of variables
		 * using faker library
		 * string   menuItemName    name of menu item
		 * string   menuItemAlias   alias of menu item
		 */
		$menuItemName = $this->menuItemName;
		$menuItemAlias = $this->menuItemAlias;

		MenuItemStep::menuItem($I, $menuItemName, $menuItemAlias, '', 'Articles', 'Archived Article');
		FrontEnd::isVisible($I, $menuItemName);
	}

	/**
	 * Unpublish a menu
	 *
	 * @param   \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since __DEPLOY_VERSION__
	 *
	 * @return void
	 */
	public function unpublishMenuItem(\AcceptanceTester $I)
	{

		$I->comment('I am going to unpublish a menu');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		$I->clickToolbarButton('unpublish');
		
		FrontEnd::notVisible($I, $this->menuItemName);

	}


	/**
	 * Publish a menu
	 *
	 * @param   \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since __DEPLOY_VERSION__
	 *
	 * @return void
	 */
	public function publishMenuItem(\AcceptanceTester $I)
	{

		$I->comment('I am going to publish a menu');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		$I->clickToolbarButton('publish');
		
		FrontEnd::isVisible($I, $this->menuItemName);

	}

	/**
	 * Check In A Menu Item
	 *
	 * @param   \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since __DEPLOY_VERSION__
	 *
	 * @return void
	 */
	public function checkInMenuItem(\AcceptanceTester $I)
	{

		$I->comment('I am going to check in a menu item');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		$I->click(Administrator\MenuItemList::$checkInButton);

	}

	/**
	 * Set A Menu Item To Home
	 *
	 * @param   \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since __DEPLOY_VERSION__
	 *
	 * @return void
	 */
	public function setHomeMenuItem(\AcceptanceTester $I)
	{

		$I->comment('I am going to set a menu item to home');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		//Home button doesn't exist in JoomlaBrowser.php file (joomla-browser)
		$I->click(Administrator\MenuItemList::$homeButton);

		FrontEnd::isVisible($I, $this->menuItemName);		
	}

	/**
	 * Rebuild A Menu Item
	 *
	 * @param   \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since __DEPLOY_VERSION__
	 *
	 * @return void
	 */
	public function rebuildMenuItem(\AcceptanceTester $I)
	{

		$I->comment('I am going to rebuild a menu item');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		$I->clickToolbarButton('rebuild');

	}

	/**
	 * Trash Menu Items
	 *
	 * @param   \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since __DEPLOY_VERSION__
	 *
	 * @return void
	 */
	public function trashMenuItem(\AcceptanceTester $I)
	{

		 $I->comment('I am going to trash a menu item');
		 $I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		$I->searchForItem('Home');
		$I->click(Administrator\MenuItemList::$check);
		$I->click(Administrator\MenuItemList::$homeButton);

		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		$I->clickToolbarButton('trash');
		
		FrontEnd::notVisible($I, $this->menuItemName);

	}

}
