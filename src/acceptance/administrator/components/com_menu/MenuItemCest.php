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

        /**
         * Creates a menu item with the Joomla menu manager
         *
         * @param \AcceptanceTester $I
         *
         * @throws \Exception
         * @since  3.0.0
         * @return void
         */
        public function menuItem(\AcceptanceTester $I)
        {

            /**
             * Initializing values of variables
             * using faker library
             * string   menuItemName    name of menu item
             * string   menuItemAlias   alias of menu item
             */
            $menuItemName = 'Menu Item 101 ';
            $menuItemAlias = 'MenuItem101';

            $I->comment('I am going to create a menu item');
            $I->doAdministratorLogin();

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

            $I->click(Administrator\MenuItem::$selectCategory);

            $I->fillField(Administrator\MenuItem::$menuItemTitle, $menuItemName);
            $I->fillField(Administrator\MenuItem::$menuItemAlias, $menuItemAlias);

            //Select option from dropdown menu
            $I->waitForElement(Administrator\MenuItem::$menuDropDown);
            $I->click(Administrator\MenuItem::$menuDropDown);
            $option = $I->grabTextFrom(Administrator\MenuItem::$selectOption);
            $I->selectOption(Administrator\MenuItem::$menuDropDown, $option);

            //Save the menu item
            $I->click(Administrator\MenuItem::$dropDownToggle);
            $I->clickToolbarButton('save & close');

            // Success message
            $I->see(Administrator\MenuItem::$successMessage, Administrator\AdminPage::$systemMessageContainer);

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

            $I->clickToolbarButton('trash');

        }

    }
