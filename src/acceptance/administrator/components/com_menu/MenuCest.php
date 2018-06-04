<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Page\Acceptance\Administrator\MenuListPage;
use Page\Acceptance\Administrator\MenuFormPage;
use Page\Acceptance\Administrator\AdminPage;
/**
 * Administrator Menu Tests
 *
 * @since  __DEPLOY_VERSION__
 */
class MenuCest
{
	public function __construct()
	{
		$this->menuTitle = 'Testing Final Menu A123';
		$this->type = 'Test129';
		$this->description = 'Alright Automation Testing for Menus';
	}
	/**
	 * Create a menu
	 *
	 * @param   AcceptanceTester  $I  The AcceptanceTester Object
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return  void
	 */
	public function createNewMenu(\AcceptanceTester $I)
	{
		$I->comment('I am going to create a menu');
		$I->doAdministratorLogin();

		$I->amOnPage(MenuListPage::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->waitForText(MenuListPage::$pageTitleText);
		$I->click(['id' => "menu-collapse"]);

		$I->clickToolbarButton('new');
		$I->waitForText(MenuFormPage::$pageTitleText);
		$I->checkForPhpNoticesOrWarnings();

		$this->fillMenuInformation($I, $this->menuTitle, $this->type, $this->description);

		$I->click(MenuFormPage::$dropDownToggle);
		$I->clickToolbarButton('save & close');

		$I->waitForText(MenuListPage::$pageTitleText);
		$I->checkForPhpNoticesOrWarnings();
	}

	/**
	 * Fill out the menu information form
	 *
	 * @param   AcceptanceTester  $I            The AcceptanceTester Object
	 * @param   string            $title        Title
	 * @param   string            $type         Type of the menu
	 * @param   string            $description  Description
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return  void
	 */
	protected function fillMenuInformation($I, $title, $type, $description)
	{
		$I->fillField(MenuFormPage::$fieldTitle, $title);
		$I->fillField(MenuFormPage::$fieldMenuType, $type);
		$I->fillField(MenuFormPage::$fieldMenuDescription, $description);
	}

	public function rebuildMenu(\AcceptanceTester $I){

		$I->comment('I am going to rebuild a menu');
		$I->doAdministratorLogin();

		$I->amOnPage(MenuListPage::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->searchForItem($this->menuTitle);
		$I->click(MenuListPage::$menuSelect);

		//$I->clickToolbarButton('rebuild');
		$I->clickToolbarButton('rebuild');

		$I->see('Successfully rebuilt',AdminPage::$systemMessageContainer);
	}


	public function deleteMenu(\AcceptanceTester $I){
		$I->comment('I am going to delete a menu');
		$I->doAdministratorLogin();

		$I->amOnPage(MenuListPage::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->searchForItem($this->menuTitle);
		$I->click(MenuListPage::$menuSelect);
		$I->clickToolbarButton('delete');

	}

}
