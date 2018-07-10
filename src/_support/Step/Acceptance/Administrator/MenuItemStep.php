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

/**
 * Acceptance Step object class contains suits for MenuItem.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    4.0.0
 */
class MenuItemStep extends Admin
{
	/**
	 * Create A New MenuItem
	 *
	 * @param   string             $menuItemName       The Title Of Menu Item
	 * @param   string             $menuItemAlias      The Alias Of Menu Item
	 * @param   string             $title              The Title Of Category or Article or Contact or News Feed
	 * @param   string             $menuItemType       The type of MenuItem
	 * @param   string             $optionForMenuType  ( Archived Articles, Featured, Category Blog, etc)
	 * @param   string             $tag                Tag
	 *
	 * @since   4.0.0
	 * @return void
	 */
	public function createMenuItem($menuItemName, $menuItemAlias, $title, $menuItemType = 'Articles', $optionForMenuType = 'List All Categories', $tag = 'joomlaorg' )
	{
		$this->comment('I am going to create a menu item');
		$this->doAdministratorLogin();
		$this->amOnPage(Administrator\MenuItemListPage::$url);
		$this->checkForPhpNoticesOrWarnings();
		$this->waitForText(Administrator\MenuItemFormPage::$pageTitleText);
		/**
		 * Creating A New Menu item
		 *  1. click on "new" botton
		 *  2. fill the Menu Select type
		 *  3. fill two fields : menu item name and alias
		 *  4. click on "save" button
		 */
		$this->click("#menu-collapse");
		$this->clickToolbarButton('new');
		$this->fillField(Administrator\MenuItemFormPage::$menuItemTitle, $menuItemName);
		$this->fillField(Administrator\MenuItemFormPage::$menuItemAlias, $menuItemAlias);

		// Select option from dropdown menu  : MAIN MENU
		$this->click(Administrator\MenuItemFormPage::$menuDropDown);
		$option = $this->grabTextFrom(Administrator\MenuItemFormPage::$selectOption);
		$this->selectOption(Administrator\MenuItemFormPage::$menuDropDown, $option);
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
		$this->waitForText('Select');
		$this->click('Select');
		$this->waitForElement(Administrator\MenuItemFormPage::$menuTypeModal, TIMEOUT);
		$this->switchToIFrame("Menu Item Type");
		$this->wait(1);
		// Menu Item Type
		$this->click($menuItemType);
		// Option in Menu Item type
		$this->waitForElement("//div[contains(text(), '".$optionForMenuType."')]", TIMEOUT);
		$this->scrollTo("//div[contains(text(),'".$optionForMenuType."')]");
		$this->click("//div[contains(text(), '".$optionForMenuType."')]");
		switch ($menuItemType)
		{
			case 'Articles' :
				/**
				 * Options under Articles
				 * Archived Article
				 * Featured Article
				 * Create Article
				 * Category Blog
				 * Category List
				 * List All Categories
				 * Single Article
				 */
				switch ($optionForMenuType) {
					case 'List All Categories' :
						// Select Option
						$this->selectOption(Administrator\MenuItemFormPage::$selectMenuType, $title);
						break;
					case 'Archived Article':
						// Select Option
						$this->selectOption(Administrator\MenuItemFormPage::$selectArchivedArticle, $title);
						break;
					case 'Category Blog' :
						// Selecting Category
						$this->click(Administrator\MenuItemFormPage::$select);
						$this->switchToIFrame('Select or Change Category');
						// Search
						$this->searchForItem($title);
						$this->see($title);
						$this->click(['link' => $title]);
						$this->switchToPreviousTab();
						break;
					case 'Single Article' :
						// Selecting Article
						$this->click(Administrator\MenuItemFormPage::$select);
						$this->switchToIFrame('Select or Change article');
						// Search
						$this->searchForItem($title);
						$this->see($title);
						$this->click(['link' => $title]);
						$this->switchToPreviousTab();
						break;
					case 'Featured Article':
						break;
					case 'Category List' :
						$this->wait(1);
						// Selecting Article
						$this->click(Administrator\MenuItemFormPage::$select);
						$this->switchToIFrame('Select or Change article');
						// Search
						$this->searchForItem($title);
						$this->see($title);
						$this->click(['link' => $title]);
						$this->switchToPreviousTab();
						break;
					case 'Create Article':
						break;
				}
				break;
			case 'Configuration Manager' :
				/**
				 * Two Options
				 * Display Template Options
				 * Site Configuration Options
				 */
				switch ($optionForMenuType){
					case 'Display Template Options' :
						break;
					case 'Site Configuration Options':
						break;
				}
				break;
			case  'Contacts' :
				/**
				 * Options
				 * Featured Contacts
				 * All Contact Categories
				 * List Contacts in a Category
				 * Single Contact
				 */
				switch ($optionForMenuType) {
					case 'Featured Contacts' :
						break;
					case 'All Contact Categories' :
						break;
					case 'List Contacts in a Category' :
						// Selecting Article
						$this->click(Administrator\MenuItemFormPage::$select);
						$this->switchToIFrame('Select or Change Category');
						// Search
						$this->searchForItem('Uncategorised');
						$this->see('Uncategorised');
						$this->click(['link' => 'Uncategorised']);
						$this->switchToPreviousTab();
						break;
					case 'Single Contact' :
						// Selecting Article
						$this->click(Administrator\MenuItemFormPage::$select);
						$this->switchToIFrame('Select or Change Contact');
						// Search
						$this->searchForItem($title);
						$this->see($title);
						$this->click(['link' => $title]);
						$this->switchToPreviousTab();
						break;
				}
				break;
			case  'News Feeds' :
				/**
				 * Options
				 * List All News Feed Categories
				 * List News Feeds in a Category
				 * Single News Feed
				 */
				switch ($optionForMenuType) {
					case 'List All News Feed Categories' :
						break;
					case 'List News Feeds in a Category' :
						// Selecting Category
						$this->click(Administrator\MenuItemFormPage::$select);
						$this->switchToIFrame('Select or Change Category');
						$this->searchForItem($title);
						$this->see($title);
						$this->click(['link' => $title]);
						$this->switchToPreviousTab();
						break;
					case 'Single News Feed' :
						// Selecting Category
						$this->click(Administrator\MenuItemFormPage::$select);
						$this->switchToIFrame('Select or Change News Feed');
						$this->searchForItem($title);
						$this->see($title);
						$this->click(['link' => $title]);
						$this->switchToPreviousTab();
						break;
				}
				break;
			case  'Search'  :
				/**
				 * Options
				 * Search Form or Search Results
				 */
				break;
			case  'Smart Search' :
				/**
				 * Option
				 * Search
				 */
				break;
			case  'System Links' :
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
						break;
					case 'Menu Item Alias' :
						break;
					case 'Separator' :
						break;
					case 'URL' :
						break;
				}
				break;
			case  'Users'  :
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
						break;
					case 'Login Form':
						break;
					case 'Logout':
						break;
					case 'Password Reset':
						break;
					case 'Registration Form':
						break;
					case 'User Profile':
						break;
					case 'Username Reminder Request':
						break;
				}
				break;
			case  'Wrapper' :
				/**
				 * Options
				 * Iframe Wrapper
				 */
				$this->fillField(Administrator\MenuItemFormPage::$wrapperUrl,'https://www.google.com');
				break;
		}
		$this->waitForElement(Administrator\MenuItemFormPage::$dropDownToggle, TIMEOUT);
		// Save the menu item
		$this->click(Administrator\MenuItemFormPage::$dropDownToggle);
		$this->clickToolbarButton('save & close');
		$this->see(Administrator\MenuItemFormPage::$successMessage,Administrator\AdminPage::$systemMessageContainer);
		$this->searchForItem($menuItemName);
	}
}
