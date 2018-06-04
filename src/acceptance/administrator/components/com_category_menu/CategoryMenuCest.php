<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace administrator\components\com_category_menu;

use Step\Acceptance\Administrator\Category as CategoryStep;
use Step\Acceptance\Administrator\Content as ContentStep;
use Step\Acceptance\Site\FrontEnd as FrontEnd;
use Page\Acceptance\Administrator;
use Faker\Factory as fakerLib;

/**
 * Category Menu class
 *
 * @since __DEPLYED_VERSION__
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
	 * @param \AcceptanceTester $I
	 * @param $scenario
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
	 * @param \AcceptanceTester $I
	 * @param $scenario
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
	 * @param  \AcceptanceTester $I
	 *
	 * @throws \Exception
	 *
	 * @return void
	 */
	public function createMenuForCategory(\AcceptanceTester $I)
	{
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

		$I->fillField(Administrator\MenuItemForm::$menuItemTitle, $this->menuItemName);
		$I->fillField(Administrator\MenuItemForm::$menuItemAlias, $this->menuItemAlias);
		$I->waitForText('Select');
		$I->click('Select');
		$I->checkForPhpNoticesOrWarnings();
		$I->switchToIFrame();
		$I->waitForElement(Administrator\MenuItemForm::$menuTypeModal, TIMEOUT);
		$I->switchToIFrame("Menu Item Type");
		$I->waitForElement(Administrator\MenuItemForm::$articlesLink, TIMEOUT);
		$I->click(['link' => 'Articles']);
		/**
		 * Options under Articles
		 * Archived Article
		 * Featured Article
		 * Create Article
		 * Category Blog
		 * Category List
		 * List All Categories  <- We chose this Option
		 * Single Article
		 */
		$I->wait(.5);
		$I->waitForElement( "//div[contains(text(), 'List All Categories')]", TIMEOUT);
		$I->scrollTo("//div[contains(text(), 'List All Categories')]");
		$I->click("//div[contains(text(), 'List All Categories')]");

		//Select Option
		$I->selectOption(Administrator\MenuItemForm::$selectMenuType,$this->categoryTitle);

		//Select option from dropdown menu
		$I->click(Administrator\MenuItemForm::$menuDropDown);
		$option = $I->grabTextFrom(Administrator\MenuItemForm::$selectOption);
		$I->selectOption(Administrator\MenuItemForm::$menuDropDown, $option);

		//Save the menu item
		$I->click(Administrator\MenuItemForm::$dropDownToggle);
		$I->clickToolbarButton('save & close');

		// Success message
		$I->see(Administrator\MenuItemForm::$successMessage, Administrator\AdminPage::$systemMessageContainer);

		$I->searchForItem($this->menuItemName);
}
	/**
	 * Unpublish Menu Items and check front end
	 *
	 * @param   \AcceptanceTester $I
	 *
	 * @return  void
	 */
	public function unpublishMenuItems(\AcceptanceTester $I)
	{
		$I->comment('I am going to unpublish a menu');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\MenuItemList::$url);
		$I->checkForPhpNoticesOrWarnings();

		//Select 'Main Menu'
		$I->click(Administrator\MenuItemList::$selectMenu);
		$option = $I->grabTextFrom(Administrator\MenuItemList::$selectMainMenu);
		$I->selectOption(Administrator\MenuItemList::$selectMenu, $option);

		//Search For Menu Item
		$I->searchForItem($this->menuItemName);
		$I->click(Administrator\MenuItemList::$check);

		$I->clickToolbarButton('unpublish');

		//Check In FrontEnd
		FrontEnd::notVisible($I,$this->menuItemName);
	}
	/**
	 * Publish Menu Items
	 *
	 * @param   \AcceptanceTester $I
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
	 * @param   \AcceptanceTester $I
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
	 * @param   \AcceptanceTester $I
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
	 * @param   \AcceptanceTester $I
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
