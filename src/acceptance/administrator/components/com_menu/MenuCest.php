<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


use Page\Acceptance\Administrator\MenuManagerPage as MenuPage;
use Page\Acceptance\Administrator\MenuEditPage as EditPage;
use Page\Acceptance\Administrator\AdminPage as AdminPage;
use Page\Acceptance\Administrator\MenuItem as MenuItem;
/**
 * Administrator Menu Tests
 *
 * @since  __DEPLOY_VERSION__
 */
class MenuCest
{
	/**
	 * Create a menu
	 *
	 * @param AcceptanceTester $I The AcceptanceTester Object
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return  void
	 */
    public function createNewMenu(\AcceptanceTester $I)
    {
        $I->comment('I am going to create a menu');
	    $I->doAdministratorLogin();

	    $I->amOnPage(MenuPage::$url);
	    $I->checkForPhpNoticesOrWarnings();

	    $I->waitForText(MenuPage::$pageTitleText);

	    $I->clickToolbarButton('new');
	    $I->waitForText(EditPage::$pageTitleText);
	    $I->checkForPhpNoticesOrWarnings();

	    $this->fillMenuInfo($I);

    	$I->clickToolbarButton('save');
	    $I->waitForText(MenuPage::$pageTitleText);
	    $I->checkForPhpNoticesOrWarnings();

        $I->see('Menu saved',AdminPage::$systemMessageContainer);
		//
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

	protected function fillMenuInfo($I)
	{
		$I->fillField(EditPage::$fieldTitle,'MenuNumOne');
		$I->fillField(EditPage::$fieldMenuType,'mn1');
		$I->fillField(EditPage::$fieldMenuDescription, 'This is a test menu');
	}


   public function rebuildMenu(\AcceptanceTester $I){

	   $I->comment('I am going to rebuild a menu');
       $I->doAdministratorLogin();

       $I->amOnPage(MenuPage::$url);
       $I->checkForPhpNoticesOrWarnings();

       $I->click(MenuPage::$menuSelect);

       //$I->clickToolbarButton('rebuild');
        $I->click(MenuItem::$rebuildButton);

       $I->see('Successfully rebuilt',AdminPage::$systemMessageContainer);
   }


    public function deleteMenu(\AcceptanceTester $I){
        $I->comment('I am going to delete a menu');
        $I->doAdministratorLogin();

        $I->amOnPage(MenuPage::$url);
        $I->checkForPhpNoticesOrWarnings();

        $I->click(MenuPage::$menuSelect);
        $I->clickToolbarButton('delete');

    }

}
