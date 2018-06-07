<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Step
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Step\Acceptance\Administrator;

use Page\Acceptance\Administrator;
use Step\Acceptance\Administrator\Admin;
/**
 * Acceptance Step object class contains suits for MenuItem.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class MenuItem extends Admin
{
	/**
	 * Create A New MenuItem
	 *
	 * @param   \AcceptanceTester $I                 The Acceptance Tester
	 * @param   string            $menuItemName      The Title Of Menu Item
	 * @param   string            $menuItemAlias     The Alias Of Menu Item
	 * @param   string            $title             The Title Of Category or Article or Contact or News Feed
	 * @param   string            $menuItemType      The type of MenuItem
	 * @param   string            $optionForMenuType ( Archived Articles, Featured, Category Blog, etc)
	 * @param   string            $tag               Tag
	 *
	 * @since   __DEPLOY_VERSION__
	 * @return void
	 */
	public function menuItem(\AcceptanceTester $I ,$menuItemName, $menuItemAlias, $title, $menuItemType = 'Articles', $optionForMenuType = 'List All Categories', $tag = 'joomlaorg' )
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
		$I->fillField(Administrator\MenuItemForm::$menuItemTitle, $menuItemName);
		$I->fillField(Administrator\MenuItemForm::$menuItemAlias, $menuItemAlias);
		// Select option from dropdown menu  : MAIN MENU
		$I->click(Administrator\MenuItemForm::$menuDropDown);
		$option = $I->grabTextFrom(Administrator\MenuItemForm::$selectOption);
		$I->selectOption(Administrator\MenuItemForm::$menuDropDown, $option);
		/**
		 * Menu Type
		 * Articles
		 * News Feed
		 * Search
		 * Smart Search
		 * Configuration Manager
		 * Contacts
		 * System Links
		 * Tags
		 * Wrapper
		 */
		$I->waitForText('Select');
		$I->click('Select');
		$I->waitForElement(Administrator\MenuItemForm::$menuTypeModal, TIMEOUT);
		$I->switchToIFrame("Menu Item Type");
		$I->wait(1);
		switch ($menuItemType)
		{
			case 'Articles' :
				$I->click(['link' => 'Articles']);
				/**
				 * Options under Articles
				 * Archived Article  .
				 * Featured Article  .
				 * Create Article  .
				 * Category Blog  .
				 * Category List  .
				 * List All Categories .
				 * Single Article .
				 */
				switch ($optionForMenuType) {
					case 'List All Categories' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'List All Categories')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'List All Categories')]");
						$I->click("//div[contains(text(), 'List All Categories')]");
						// Select Option
						$I->selectOption(Administrator\MenuItemForm::$selectMenuType, $title);
						break;
					case 'Archived Article':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Archived Article')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Archived Article')]");
						$I->click("//div[contains(text(), 'Archived Article')]");
						// Select Option
						$I->selectOption(Administrator\MenuItemForm::$selectArchivedArticle, $title);
						break;
					case 'Category Blog' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Category Blog')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Category Blog')]");
						$I->click("//div[contains(text(), 'Category Blog')]");
						// Selecting Category
						$I->click(Administrator\MenuItemForm::$select);
						$I->switchToIFrame('Select or Change Category');
						$I->wait(.8);
						$I->searchForItem($title);
						$I->wait(.8);
						$I->see($title);
						$I->click(['link' => $title]);
						$I->switchToPreviousTab();
						break;
					case 'Single Article' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Single Article')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Single Article')]");
						$I->click("//div[contains(text(), 'Single Article')]");
						// Selecting Article
						$I->click(Administrator\MenuItemForm::$select);
						$I->switchToIFrame('Select or Change article');
						$I->wait(1);
						$I->searchForItem($title);
						$I->see($title);
						$I->click(['link' => $title]);
						$I->switchToPreviousTab();
						break;
					case 'Featured Article':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Archived Article')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Archived Article')]");
						$I->click("//div[contains(text(), 'Archived Article')]");
						break;
					case 'Category List' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Single Article')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Single Article')]");
						$I->click("//div[contains(text(), 'Single Article')]");
						// Selecting Article
						$I->click(Administrator\MenuItemForm::$select);
						$I->switchToIFrame('Select or Change article');
						$I->wait(1);
						$I->searchForItem($title);
						$I->see($title);
						$I->click(['link' => $title]);
						$I->switchToPreviousTab();
						break;
					case 'Create Article':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Archived Article')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Archived Article')]");
						$I->click("//div[contains(text(), 'Archived Article')]");
						break;
				}
				break;
			case 'Configuration Manager' :
				$I->click(['link' => 'Configuration Manager']);
				/**
				 * Two Options
				 * Display Template Options
				 * Site Configuration Options
				 */
				switch ($optionForMenuType){
					case 'Display Template Options' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Display Template Options')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Display Template Options')]");
						$I->click("//div[contains(text(), 'Display Template Options')]");
						break;
					case 'Site Configuration Options':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Site Configuration Options')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Site Configuration Options')]");
						$I->click("//div[contains(text(), 'Site Configuration Options')]");
						break;
				}
				break;
			case  'Contacts' :
				$I->click(['link' => 'Contacts']);
				/**
				 * Options
				 * Featured Contacts
				 * All Contact Categories
				 * List Contacts in a Category
				 * Single Contact
				 */
				switch ($optionForMenuType) {
					case 'Featured Contacts' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Featured Contacts')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Featured Contacts')]");
						$I->click("//div[contains(text(), 'Featured Contacts')]");
						break;
					case 'All Contact Categories' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'All Contact Categories')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'All Contact Categories')]");
						$I->click("//div[contains(text(), 'All Contact Categories')]");
						break;
					case 'List Contacts in a Category' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'List Contacts in a Category')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'List Contacts in a Category')]");
						$I->click("//div[contains(text(), 'List Contacts in a Category')]");
						// Selecting Article
						$I->click(Administrator\MenuItemForm::$select);
						$I->switchToIFrame('Select or Change Category');
						$I->wait(1);
						$I->searchForItem('Uncategorised');
						$I->see('Uncategorised');
						$I->click(['link' => 'Uncategorised']);
						$I->switchToPreviousTab();
						break;
					case 'Single Contact' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'List Contacts in a Category')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'List Contacts in a Category')]");
						$I->click("//div[contains(text(), 'List Contacts in a Category')]");
						// Selecting Article
						$I->click(Administrator\MenuItemForm::$select);
						$I->switchToIFrame('Select or Change Contact');
						$I->wait(1);
						$I->searchForItem($title);
						$I->see($title);
						$I->click(['link' => $title]);
						$I->switchToPreviousTab();
						break;
				}
				break;
			case  'News Feeds' :
				$I->click(['link' => 'News Feeds']);
				/**
				 * Options
				 * List All News Feed Categories
				 * List News Feeds in a Category
				 * Single News Feed
				 */
				switch ($optionForMenuType) {
					case 'List All News Feed Categories' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'List All News Feed Categories')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'List All News Feed Categories')]");
						$I->click("//div[contains(text(), 'List All News Feed Categories')]");
						break;
					case 'List News Feeds in a Category' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'List News Feeds in a Category')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'List News Feeds in a Category')]");
						$I->click("//div[contains(text(), 'List News Feeds in a Category')]");
						// Selecting Category
						$I->click(Administrator\MenuItemForm::$select);
						$I->switchToIFrame('Select or Change Category');
						$I->wait(1);
						$I->searchForItem($title);
						$I->see($title);
						$I->click(['link' => $title]);
						$I->switchToPreviousTab();
						break;
					case 'Single News Feed' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Single News Feed')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Single News Feed')]");
						$I->click("//div[contains(text(), 'Single News Feed')]");
						// Selecting Category
						$I->click(Administrator\MenuItemForm::$select);
						$I->switchToIFrame('Select or Change News Feed');
						$I->wait(1);
						$I->searchForItem($title);
						$I->see($title);
						$I->click(['link' => $title]);
						$I->switchToPreviousTab();
						break;
				}
				break;
			case  'Search'  :
				$I->click(['link' => 'Search']);
				/**
				 * Options
				 * Search Form or Search Results
				 */
				$I->wait(1);
				$I->waitForElement("//div[contains(text(), 'Search Form or Search Results')]", TIMEOUT);
				$I->scrollTo("//div[contains(text(),'Search Form or Search Results')]");
				$I->click("//div[contains(text(), 'Search Form or Search Results')]");
				break;
			case  'Smart Search' :
				$I->click(['link' => 'Search']);
				/**
				 * Option
				 * Search
				 */
				$I->wait(1);
				$I->waitForElement("//div[contains(text(), 'Search')]", TIMEOUT);
				$I->scrollTo("//div[contains(text(),'Search')]");
				$I->click("//div[contains(text(), 'Search')]");
				break;
			case  'System Links' :
				$I->click(['link' => 'System Links']);
				/**
				 * Options
				 * Menu Heading
				 * Menu Item Alias
				 * Separator
				 * URL
				 */
				switch ($optionForMenuType)
				{
					case 'Menu Heading':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Menu Heading')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Menu Heading')]");
						$I->click("//div[contains(text(), 'Menu Heading')]");
						break;
					case 'Menu Item Alias' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Menu Item Alias')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Menu Item Alias')]");
						$I->click("//div[contains(text(), 'Menu Item Alias')]");
						break;
					case 'Separator' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Separator')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Separator')]");
						$I->click("//div[contains(text(), 'Separator')]");
						break;
					case 'URL' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'URL')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'URL')]");
						$I->click("//div[contains(text(), 'URL')]");
						break;
				}
				break;
			case  'Tags'  :
				$I->click(['link' => 'System Links']);
				/**
				 * Options
				 * Compact list of tagged items
				 * List of all tags
				 * Tagged Items
				 */
				switch ($optionForMenuType)
				{
					case 'Compact list of tagged items' :
						//Need to create tags first
						break;
					case 'List of all tags' :
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'List of all tags')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'List of all tags')]");
						$I->click("//div[contains(text(), 'List of all tags')]");
						break;
					case 'Tagged Items' :
						//Need to create tags
						break;
				}
				break;
			case  'Users'  :
				$I->click(['link' => 'Users']);
				/**
				 * Options
				 * Edit User Profile
				 * Login Form
				 * Logout
				 * Password Reset
				 * Registration Form
				 * User Profile
				 * Username Reminder Request
				 */
				switch ($optionForMenuType)
				{
					case 'Edit User Profile':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Edit User Profile')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Edit User Profile')]");
						$I->click("//div[contains(text(), 'Edit User Profile')]");
						break;
					case 'Login Form':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Login Form')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Login Form')]");
						$I->click("//div[contains(text(), 'Login Form')]");
						break;
					case 'Logout':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Logout')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Logout')]");
						$I->click("//div[contains(text(), 'Logout')]");
						break;
					case 'Password Reset':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Password Reset')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Password Reset')]");
						$I->click("//div[contains(text(), 'Password Reset')]");
						break;
					case 'Registration Form':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Registration Form')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Registration Form')]");
						$I->click("//div[contains(text(), 'Registration Form')]");
						break;
					case 'User Profile':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'User Profile')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'User Profile')]");
						$I->click("//div[contains(text(), 'User Profile')]");
						break;
					case 'Username Reminder Request':
						$I->wait(1);
						$I->waitForElement("//div[contains(text(), 'Username Reminder Request')]", TIMEOUT);
						$I->scrollTo("//div[contains(text(),'Username Reminder Request')]");
						$I->click("//div[contains(text(), 'Username Reminder Request')]");
						break;
				}
				break;
			case  'Wrapper' :
				$I->click(['link' => 'Users']);
				/**
				 * Options
				 * Iframe Wrapper
				 */
				$I->wait(1);
				$I->waitForElement("//div[contains(text(), 'Iframe Wrapper')]", TIMEOUT);
				$I->scrollTo("//div[contains(text(),'Iframe Wrapper')]");
				$I->click("//div[contains(text(), 'Iframe Wrapper')]");
				$I->fillField(Administrator\MenuItemForm::$wrapperUrl,'https://www.google.com');
				break;
		}
		// Save the menu item
		$I->wait(1);
		$I->click(Administrator\MenuItemForm::$dropDownToggle);
		$I->clickToolbarButton('save & close');
		// Success message
		$I->see(Administrator\MenuItemForm::$successMessage, Administrator\AdminPage::$systemMessageContainer);
		$I->searchForItem($menuItemName);
	}
}