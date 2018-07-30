<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Step\Acceptance\Administrator\MenuItemStep;
use Step\Acceptance\Administrator\Category as CategoryStep;
use Step\Acceptance\Administrator\Content as ContentStep;
use Step\Acceptance\Site\FrontEnd;
use Page\Acceptance\Administrator\AdminPage;
use Page\Acceptance\Administrator\MenuItemListPage;

/**
 * Category Menu class
 *
 * @category  Menu_Article
 * @package   Administratorcomponentscom_Menu_Article
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @since     4.0.0
 */
class CategoryMenuCest
{
	/**
	 * CategoryMenuCest constructor.
	 */
	public function __construct()
	{
		$this->categoryTitle = 'Joomla category453';
		$this->articleTitle = 'Joomla Article2453';
		$this->articleContent = 'This is the content for Article Joomla Org';
		$this->menuItemName = 'Menu Item943';
		$this->menuItemAlias = 'MIAJOrg923';
	}

	/**
	 * Create Category
	 *
	 * @param   \AcceptanceTester $I         The Acceptance Tester object
	 * @param   string            $scenario  Scenario
	 * @return  void
	 */
	public function Category(\AcceptanceTester $I, $scenario)
	{
		$I = new CategoryStep($scenario);

		$I->doAdministratorLogin();
		$I->createContentCategory($this->categoryTitle);
	}

	/**
	 * Create Articles in Category
	 *
	 * @param   \AcceptanceTester $I          Acceptance Tester
	 * @param   string            $scenario   Scenario
	 *
	 * @return void
	 */
	public function createArticles(\AcceptanceTester $I, $scenario)
	{
		$I = new ContentStep($scenario);

		for ($j=0;$j<2;$j++)
		{
			$I->doAdministratorLogin();
			$I->createArticle($this->articleTitle . $j, $this->articleContent, $this->categoryTitle);
		}
	}

	/**
	 * Publish Menu Items
	 *
	 * @param  MenuItemStep $I Acceptance Tester
	 *
	 * @throws \Exception
	 *
	 * @return void
	 */
	public function createMenuForCategory(MenuItemStep $I)
	{
		$I->createMenuItem($this->menuItemName, $this->menuItemAlias, $this->categoryTitle, 'Articles', 'Category Blog');
	}

	/**
	 * Unpublish Menu Items and check front end
	 *
	 * @param   \AcceptanceTester $I         Acceptance Tester
	 * @param   string            $scenario  Scenario
	 * @return  void
	 */
	public function unpublishMenuItems(\AcceptanceTester $I, $scenario)
	{
		$I->comment('I am going to unpublish a menu');
		$I->doAdministratorLogin();
		// URL
		$I->amOnPage(MenuItemListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		// Select 'Main Menu'
		$I->click(MenuItemListPage::$selectMenu);
		$option = $I->grabTextFrom(MenuItemListPage::$selectMainMenu);
		$I->selectOption(MenuItemListPage::$selectMenu, $option);
		// Search For Menu Item
		$I->searchForItem($this->menuItemName);
		$I->click(MenuItemListPage::$checkItemOne);
		$I->clickToolbarButton('unpublish');
		// Assertion
		$I->setFilter('select status', 'Unpublished');
		$I->searchForItem($this->menuItemName);
		$I->see($this->menuItemName);
		// FrontEnd Assertion
		$I = new FrontEnd($scenario);
		$I->notVisible($this->menuItemName, $this->articleTitle);
	}

	/**
	 * Publish Menu Items
	 *
	 * @param   \AcceptanceTester $I         Acceptance Tester
	 * @param   string            $scenario  Scenario
	 *
	 * @return  void
	 */
	public function publishMenuItems(\AcceptanceTester $I, $scenario)
	{
		$I->comment('I am going to publish a menu');
		$I->doAdministratorLogin();
		// URL
		$I->amOnPage(MenuItemListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		//Set Menu To 'Main Menu'
		$I->click(MenuItemListPage::$selectMenu);
		$option = $I->grabTextFrom(MenuItemListPage::$selectMainMenu);
		$I->selectOption(MenuItemListPage::$selectMenu, $option);
		// Search for Menu item
		$I->searchForItem($this->menuItemName);
		$I->click(MenuItemListPage::$checkItemOne);
		// Publish
		$I->clickToolbarButton('publish');
		// Assertion
		$I->setFilter('select status', 'Published');
		$I->searchForItem($this->menuItemName);
		$I->see($this->menuItemName);
		// FrontEnd Assertion
		$I = new FrontEnd($scenario);
		$I->isVisible($this->menuItemName, $this->articleTitle);
	}

	/**
	 * Set Menu Item To Home
	 *
	 * @param   \AcceptanceTester $I         Acceptance Tester
	 * @param   string            $scenario  Scenario
	 *
	 * @return  void
	 */
	public function setMenuItemHome(\AcceptanceTester $I, $scenario)
	{
		$I->comment('I am going to set a menu item home');
		$I->doAdministratorLogin();
		// URL
		$I->amOnPage(MenuItemListPage::$url);
		//Set Menu To 'Main Menu'
		$I->click(MenuItemListPage::$selectMenu);
		$option = $I->grabTextFrom(MenuItemListPage::$selectMainMenu);
		$I->selectOption(MenuItemListPage::$selectMenu, $option);
		//Search for Menu item
		$I->searchForItem($this->menuItemName);
		$I->click(MenuItemListPage::$checkItemOne);
		//Set To Home
		$I->click(MenuItemListPage::$homeButton);
		// FrontEnd Assertion
		$I = new FrontEnd($scenario);
		$I->isVisible($this->menuItemName, $this->articleTitle);
	}

	/**
	 * Rebuild Menu Items
	 *
	 * @param   \AcceptanceTester $I         Acceptance Tester
	 * @param   string            $scenario  Scenario
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	public function rebuildMenuItems(\AcceptanceTester $I, $scenario)
	{
		$I->comment('I am going to rebuild a menu item');
		$I->doAdministratorLogin();
		$I->amOnPage(MenuItemListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		//Set Menu To 'Main Menu'
		$I->click(MenuItemListPage::$selectMenu);
		$option = $I->grabTextFrom(MenuItemListPage::$selectMainMenu);
		$I->selectOption(MenuItemListPage::$selectMenu, $option);
		//Search for Menu item
		$I->searchForItem($this->menuItemName);
		$I->click(MenuItemListPage::$checkItemOne);
		// Rebuild
		$I->clickToolbarButton('rebuild');
		// Success message
		$I->see('Menu items list rebuilt', AdminPage::$systemMessageContainer);
		// FrontEnd Assertion
		$I = new FrontEnd($scenario);
		$I->isVisible($this->menuItemName, $this->articleTitle);
	}

	/**
	 * Trash Menu Items
	 *
	 * @param   \AcceptanceTester $I         Acceptance Tester
	 * @param   string            $scenario  Scenario
	 *
	 * @return  void
	 */
	public function trashMenuItems(\AcceptanceTester $I, $scenario)
	{
		$I->comment('I am going to trash a menu item');
		$I->doAdministratorLogin();
		$I->amOnPage(MenuItemListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		//Set Menu To 'Main Menu'
		$I->click(MenuItemListPage::$selectMenu);
		$option = $I->grabTextFrom(MenuItemListPage::$selectMainMenu);
		$I->selectOption(MenuItemListPage::$selectMenu, $option);
		//Set 'Home' To Home To Trash
		$I->searchForItem('Home');
		$I->click(MenuItemListPage::$checkItemOne);
		$I->click(MenuItemListPage::$homeButton);
		//Search for Menu item
		$I->searchForItem($this->menuItemName);
		$I->click(MenuItemListPage::$checkItemOne);
		// Trash
		$I->clickToolbarButton('trash');
		// Backend Assertion
		$I->setFilter('select status', 'Trashed');
		$I->searchForItem($this->menuItemName);
		$I->see($this->menuItemName);
		// FrontEnd Assertion
		$I = new FrontEnd($scenario);
		$I->notVisible($this->menuItemName, $this->articleTitle);
	}
}

