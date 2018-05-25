<?php
    /**
     * @package     Joomla.Tests
     * @subpackage  Acceptance.tests
     *
     * @copyright   Copyright (C) 20005 - 2019 Open Source Matters, Inc. All rights reserved.
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


    /**
     * Create Menu Item
     *
     * @param \AcceptanceTester $I
     *
     * @throws \Exception
     *
     * @since __DEPLOY_VERSION__
     *
     * @return void
     */
    public function createMenuItem(\AcceptanceTester $I)
    {
        /**
         * Initializing values of variables
         * using faker library
         * string   menuItemName    name of menu item
         * string   menuItemAlias   alias of menu item
         */

        $menuItemName = 'Test Menu Item Number One';
        $menuItemAlias = 'TestMenuItemOne';


        //Stating what is about to be done

        $I->comment('I am going to create a menu item');
        $I->doAdministratorLogin();

        //As per url specified in step file MenuItem

        $I->amOnPage(Administrator\MenuItem::$url);
        $I->checkForPhpNoticesOrWarnings();

        $I->waitForText(Administrator\MenuItem::$pageTitleText);

        /**
         * Creating A New Menu item
         *  1. click on "new" botton
         *  2. fill the Menu Select type
         *  3. fill two fields : menu item name and alias
         *  4. click on "save" button
         */

        $I->click(['id' => "menu-collapse"]);

        $I->clickToolbarButton('new');

        $I->waitForText('Select');

        $I->click('Select');
        $I->checkForPhpNoticesOrWarnings();
        $I->switchToIFrame();
        $I->waitForElement(Administrator\MenuItem::$menuTypeModal, TIMEOUT);
        $I->switchToIFrame("Menu Item Type");
        $I->waitForElement(Administrator\MenuItem::$articlesLink, TIMEOUT);
        $I->click(['link' => 'Articles']);
        $I->click(['link' => 'Archived Articles']);

        $I->fillField(Administrator\MenuItem::$menuItemTitle, $menuItemName);
        $I->fillField(Administrator\MenuItem::$menuItemAlias, $menuItemAlias);



        //Select option from dropdown menu

        $I->waitForElement(Administrator\MenuItem::$menuDropDown);
        $I->click(Administrator\MenuItem::$menuDropDown);
        $option = $I->grabTextFrom(Administrator\MenuItem::$selectOption);
        $I->selectOption(Administrator\MenuItem::$menuDropDown, $option);



        //Save the menu item

        $I->clickToolbarButton('save');


        // Success message
        $I->see(Administrator\MenuItem::$successMessage, Administrator\AdminPage::$systemMessageContainer);
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
    public function unpublishMenuItems(\AcceptanceTester $I)
    {

        $I->comment('I am going to unpublish a menu');
        $I->doAdministratorLogin();

        $I->amOnPage(Administrator\MenuItem::$url);
        $I->checkForPhpNoticesOrWarnings();

        $I->click(Administrator\MenuItem::$selectMenu);
        $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
        $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

        $I->click(Administrator\MenuItem::$check);

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
    public function publishMenuItems(\AcceptanceTester $I)
    {

        $I->comment('I am going to publish a menu');
        $I->doAdministratorLogin();

        $I->amOnPage(Administrator\MenuItem::$url);
        $I->checkForPhpNoticesOrWarnings();

        $I->click(Administrator\MenuItem::$selectMenu);
        $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
        $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

        $I->click(Administrator\MenuItem::$check);

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
    public function checkInMenuItems(\AcceptanceTester $I)
    {

        $I->comment('I am going to check in a menu item');
        $I->doAdministratorLogin();

        $I->amOnPage(Administrator\MenuItem::$url);
        $I->checkForPhpNoticesOrWarnings();

        $I->click(Administrator\MenuItem::$selectMenu);
        $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
        $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

        $I->click(Administrator\MenuItem::$check);

        $I->click(Administrator\MenuItem::$checkInButton);

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
    public function setHomeMenuItems(\AcceptanceTester $I)
    {

        $I->comment('I am going to set a menu item to home');
        $I->doAdministratorLogin();

        $I->amOnPage(Administrator\MenuItem::$url);
        $I->checkForPhpNoticesOrWarnings();

        $I->click(Administrator\MenuItem::$selectMenu);
        $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
        $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

        $I->click(Administrator\MenuItem::$check);

        //Home button doesn't exist in JoomlaBrowser.php file (joomla-browser)
        $I->click(Administrator\MenuItem::$homeButton);

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
    public function rebuildMenuItems(\AcceptanceTester $I)
    {

        $I->comment('I am going to rebuild a menu item');
        $I->doAdministratorLogin();

        $I->amOnPage(Administrator\MenuItem::$url);
        $I->checkForPhpNoticesOrWarnings();

        $I->click(Administrator\MenuItem::$selectMenu);
        $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
        $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

        $I->click(Administrator\MenuItem::$check);

        $I->click(Administrator\MenuItem::$rebuildButton);

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
    public function trashMenuItems(\AcceptanceTester $I)
    {

        $I->comment('I am going to trash a menu item');
        $I->doAdministratorLogin();

        $I->amOnPage(Administrator\MenuItem::$url);
        $I->checkForPhpNoticesOrWarnings();

        $I->click(Administrator\MenuItem::$selectMenu);
        $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
        $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

        $I->click(Administrator\MenuItem::$check);

        $I->click(Administrator\MenuItem::$trashButton);

    }

}

