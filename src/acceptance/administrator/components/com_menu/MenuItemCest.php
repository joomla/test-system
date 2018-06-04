<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2018 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace menuItemCest;
use Page\Acceptance\Administrator;


/**
 * Administrator Menu Items Test
 *
 * @since 3.7.3
 */

class MenuItemCest
{
	public function __construct()
	{
		$this->menuItemName = 'Menu Number Final123';
		$this->menuItemAlias = 'MenuAlias123';
	}
	/**
	 * Creates a menu item with the Joomla menu manager
	 *
	 * @param \AcceptanceTester $I
	 *
	 * @throws \Exception
	 * @since  3.0.0
	 * @return void
	 */
	public function menuItem(\AcceptanceTester $I){
		/**
		 * Initializing values of variables
		 * using faker library
		 * string   menuItemName    name of menu item
		 * string   menuItemAlias   alias of menu item
		 */
		$menuItemName = $this->menuItemName;
		$menuItemAlias = $this->menuItemAlias;

		$I->comment('I am going to create a menu item');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemForm::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->waitForText(Administrator\MenuItemForm::$pageTitleText);

		/**
		 * Creating A New Menu item
		 *  1. click on "new" botton
		 *  2. fill the Menu Select type
		 *  3. fill two fields : menu item name and alias
		 *  4. click on "save" button
		 */

		$I->click(['id' => "menu-collapse"]);

		$I->clickToolbarButton('new');

		$I->fillField(Administrator\MenuItemForm::$menuItemTitle, $menuItemName);
		$I->fillField(Administrator\MenuItemForm::$menuItemAlias, $menuItemAlias);

		$I->waitForText('Select');
		$I->click('Select');
		$I->checkForPhpNoticesOrWarnings();
		$I->switchToIFrame();
		$I->waitForElement(Administrator\MenuItemForm::$menuTypeModal, TIMEOUT);
		$I->switchToIFrame("Menu Item Type");
		$I->waitForElement(Administrator\MenuItemForm::$articlesLink, TIMEOUT);
		$I->click(['link' => 'Articles']);
		$I->click("//div[contains(text(), 'Archived Articles')]");

		//$I->see('Uncategorised');
		//$I->click(Administrator\MenuItemForm::$selectCategory);	
		//Select option from dropdown menu
		$I->waitForElement(Administrator\MenuItemForm::$menuDropDown);
		$I->click(Administrator\MenuItemForm::$menuDropDown);
		$option = $I->grabTextFrom(Administrator\MenuItemForm::$selectOption);
		$I->selectOption(Administrator\MenuItemForm::$menuDropDown, $option);

		//Save the menu item
		$I->click(Administrator\MenuItemForm::$dropDownToggle);
		$I->clickToolbarButton('save & close');

		// Success message
		$I->see(Administrator\MenuItemForm::$successMessage, Administrator\AdminPage::$systemMessageContainer);

		$I->searchForItem($menuItemName);

	}

	/**
	 * Unpublish a menu
	 *
	 * @param \AcceptanceTester $I The AcceptanceTester Object
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

	}


	/**
	 * Publish a menu
	 *
	 * @param \AcceptanceTester $I The AcceptanceTester Object
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

	}

	/**
	 * Check In A Menu Item
	 *
	 * @param \AcceptanceTester $I The AcceptanceTester Object
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
	 * @param \AcceptanceTester $I The AcceptanceTester Object
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

	}

	/**
	 * Rebuild A Menu Item
	 *
	 * @param \AcceptanceTester $I The AcceptanceTester Object
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
	 * @param \AcceptanceTester $I The AcceptanceTester Object
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

	}

}
