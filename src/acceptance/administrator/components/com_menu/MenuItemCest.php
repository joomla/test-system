<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Step\Acceptance\Administrator\MenuItemStep;
use Page\Acceptance\Administrator\MenuItemListPage;
use Page\Acceptance\Administrator\AdminPage;

/**
 * Menu Item class
 *
 * @category  Menu_Item
 * @package   Administratorcomponentscom_Menu
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @link      ArticleMenuCest
 * @since     4.0.0
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
		$this->menuItemName = 'Menu Item Test';
		$this->menuItemAlias = 'Menu Item Alias Test';
	}
	
	/**
	 * Creates a menu item with the Joomla menu manager
	 *
	 * @param  MenuItemStep $I Menuitem Step Object
	 *
	 * @throws \Exception
	 * @since  4.0.0
	 * @return void
	 */
	public function menuItem(MenuItemStep $I)
	{
		/**
		 * Initializing values of variables
		 * using faker library
		 * string   menuItemName    name of menu item
		 * string   menuItemAlias   alias of menu item
		 */
		$menuItemName = $this->menuItemName;
		$menuItemAlias = $this->menuItemAlias;
		// Call Step function to create Menu item
		$I->menuItem($menuItemName, $menuItemAlias, 'Google Summer Of Codes', 'Articles', 'Archived Article');
	}

	/**
	 * Unpublish a menu
	 *
	 * @param \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function unpublishMenuItem(\AcceptanceTester $I)
	{
		$I->comment('I am going to unpublish a menu');
		$I->doAdministratorLogin();
		$I->amOnPage(MenuItemListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		$I->click(MenuItemListPage::$selectMenu);
		$option = $I->grabTextFrom(MenuItemListPage::$selectMainMenu);
		$I->selectOption(MenuItemListPage::$selectMenu, $option);
		// Search For Menu Item
		$I->searchForItem($this->menuItemName);
		$I->click(MenuItemListPage::$checkItemOne);
		// Unpublish
		$I->clickToolbarButton('unpublish');
		// Assertion
		$I->setFilter('select status', 'Unpublished');
		$I->searchForItem($this->menuItemName);
		$I->seeElement($this->menuItemName);
	}

	/**
	 * Publish a menu
	 *
	 * @param \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function publishMenuItem(\AcceptanceTester $I)
	{
		$I->comment('I am going to publish a menu');
		$I->doAdministratorLogin();
		// URL
		$I->amOnPage(MenuItemListPage::$url);
		// Search For Menu Item
		$I->searchForItem($this->menuItemName);
		$I->click(MenuItemListPage::$checkItemOne);
		// Publish
		$I->clickToolbarButton('publish');
		// Assertion
		$I->setFilter('select status', 'Published');
		$I->searchForItem($this->menuItemName);
		$I->seeElement($this->menuItemName);
	}

	/**
	 * Check In A Menu Item
	 *
	 * @param \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function checkInMenuItem(\AcceptanceTester $I)
	{
		$I->comment('I am going to check in a menu item');
		$I->doAdministratorLogin();
		// URL
		$I->amOnPage(MenuItemListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		// Search For Menu Item
		$I->searchForItem($this->menuItemName);
		$I->click(MenuItemListPage::$checkItemOne);
		// check in button
		$I->clickToolbarButton('check-in');
		/ Assertion
		$I->see('1 menu item checked in',AdminPage::$systemMessageContainer);
	}

	/**
	 * Set A Menu Item To Home
	 *
	 * @param \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function setHomeMenuItem(\AcceptanceTester $I)
	{
		$I->comment('I am going to set a menu item to home');
		$I->doAdministratorLogin();
		// URL
		$I->amOnPage(MenuItemListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		$I->click(MenuItemListPage::$selectMenu);
		$option = $I->grabTextFrom(MenuItemListPage::$selectMainMenu);
		$I->selectOption(MenuItemListPage::$selectMenu, $option);
		// Search For Menu Item
		$I->searchForItem($this->menuItemName);
		$I->click(MenuItemListPage::$checkItemOne);
		//Home button
		$I->click(MenuItemListPage::$homeButton);
		// Assertion
		$I->see('1 menu item set to home',AdminPage::$systemMessageContainer);
		
	}

	/**
	 * Trash Menu Items
	 *
	 * @param \AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function trashMenuItem(\AcceptanceTester $I)
	{
		$I->comment('I am going to trash a menu item');
		$I->doAdministratorLogin();
		// URL
		$I->amOnPage(MenuItemListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		// Select Main Menu
		$I->click(MenuItemListPage::$selectMenu);
		$option = $I->grabTextFrom(MenuItemListPage::$selectMainMenu);
		$I->selectOption(MenuItemListPage::$selectMenu, $option);
		// Set Home To 'Home' So that you can trash Menu Item you created
		$I->searchForItem('Home');
		$I->click(MenuItemListPage::$checkItemOne);
		$I->click(MenuItemListPage::$homeButton);
		// Search For Menu Item
		$I->searchForItem($this->menuItemName);
		$I->click(MenuItemListPage::$checkItemOne);
		// Trash it
		$I->clickToolbarButton('trash');
		// Assertion
		$I->setFilter('select status', 'Trashed');
		$I->searchForItem($this->menuItemName);
		$I->seeElement($this->menuItemName);
	}
}
