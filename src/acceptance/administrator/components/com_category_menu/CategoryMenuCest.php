<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace administrator\components\com_category_menu;

use Step\Acceptance\Administrator\MenuItem as MenuItemStep;
use Step\Acceptance\Administrator\Category as CategoryStep;
use Step\Acceptance\Administrator\Content as ContentStep;
use Step\Acceptance\Site\FrontEnd as FrontEnd;
use Page\Acceptance\Administrator;
use Faker\Factory as fakerLib;

/**
 * Category Menu class
 *
 * @category  Menu_Article
 * @package   Administratorcomponentscom_Menu_Article
 * @author    Samarth sharma <samarthsharma351@gmail.com>
 * @copyright 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license   Joomla 2005-2018
 * @link      ArticleMenuCest
 * @since     __DEPLOYED_VERSION
 */
class CategoryMenuCest
{
	/**
	 * CategoryMenuCest constructor.
	 */
	public function __construct()
	{
		$faker = fakerLib::create();

		$this->categoryTitle = $faker->name;
		$this->articleTitle = $faker->name;
		$this->articleContent = $faker->text;
		$this->menuItemName = $faker->name;
		$this->menuItemAlias = $faker->userName;
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
	 * @param   \AcceptanceTester $I Acceptance Tester
	 *
	 * @throws \Exception
	 *
	 * @return void
	 */
	public function createMenuForCategory(\AcceptanceTester $I)
	{

		MenuItemStep::menuItem($I, $this->menuItemName, $this->menuItemAlias, $this->categoryTitle, 'Articles', 'Category Blog');

	}
	/**
	 * Unpublish Menu Items and check front end
	 *
	 * @param   \AcceptanceTester $I Acceptance Tester
	 *
	 * @return  void
	 */
	public function unpublishMenuItems(\AcceptanceTester $I)
	{
		$I->comment('I am going to unpublish a menu');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		// Select 'Main Menu'
		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		// Search For Menu Item
		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		$I->clickToolbarButton('unpublish');

		// Check In FrontEnd
		FrontEnd::notVisible($I,$this->menuItemName);
	}
	/**
	 * Publish Menu Items
	 *
	 * @param   \AcceptanceTester $I Acceptance Tester
	 *
	 * @return  void
	 */
	public function publishMenuItems(\AcceptanceTester $I)
	{
		$I->comment('I am going to publish a menu');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		//Set Menu To 'Main Menu'
		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		//Search for Menu item
		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		//publish
		$I->clickToolbarButton('publish');

		//Check In FrontEnd
		FrontEnd::isVisible($I,$this->menuItemName);
	}
	/**
	 * Set Menu Item To Home
	 *
	 * @param   \AcceptanceTester $I Acceptance Tester
	 *
	 * @return  void
	 */
	public function setMenuItemHome(\AcceptanceTester $I)
	{
		$I->comment('I am going to set a menu item home');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);

		//Set Menu To 'Main Menu'
		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		//Search for Menu item
		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		//Set To Home
		$I->click(Administrator\MenuItemList::$homeButton);

		//Check In FrontEnd
		FrontEnd::isVisible($I,$this->menuItemName);
	}
	/**
	 * Rebuild Menu Items
	 *
	 * @param   \AcceptanceTester $I Acceptance Tester
	 *
	 * @return  void
	 *
	 * @since   3.8.3
	 */
	public function rebuildMenuItems(\AcceptanceTester $I)
	{
		$I->comment('I am going to rebuild a menu item');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		//Set Menu To 'Main Menu'
		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		//Search for Menu item
		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		$I->clickToolbarButton('rebuild');

		// Success message
		$I->see('Menu items list rebuilt', Administrator\AdminPage::$systemMessageContainer);

		//Check In FrontEnd
		FrontEnd::isVisible($I,$this->menuItemName);
	}
	/**
	 * Trash Menu Items
	 *
	 * @param   \AcceptanceTester $I Acceptance Tester
	 *
	 * @return  void
	 */
	public function trashMenuItems(\AcceptanceTester $I)
	{
		$I->comment('I am going to trash a menu item');
		$I->doAdministratorLogin();
		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		//Set Menu To 'Main Menu'
		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		//Set 'Home' To Home To Trash
		$I->searchForItem('Home');
		$I->click(Administrator\MenuItemList::$check);
		$I->click(Administrator\MenuItemList::$homeButton);

		//Search for Menu item
		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		$I->clickToolbarButton('trash');

		//Check In FrontEnd
		FrontEnd::notVisible($I,$this->menuItemName);
	}

}

