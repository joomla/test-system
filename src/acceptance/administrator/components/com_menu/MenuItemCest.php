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
    use Page\Acceptance\Administrator\MenuManagerPage as MenuPage;
    use Faker\Factory as fakerLib;
    use \Codeception\Util\Locator;
    /**
     * Administrator Menu Items Test
     *
     * @since  3.7.3
     */

    class MenuItemCest
    {
        /**
         * @return string
         */

        public function createMenuItem(\AcceptanceTester $I)
        {
            /**
             * Initializing values of variables
             * using faker library
             * string   menuItemName    name of menu item
             * string   menuItemAlias   alias of menu item
             */
            $faker = fakerLib::create();
            $menuItemName = $faker->name;
            $menuItemAlias = $faker->userName;


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


            /**
             * select option from dropdown menu
            */
            $I->waitForElement(Administrator\MenuItem::$menuDropDown);
            $I->click(Administrator\MenuItem::$menuDropDown);
            $option = $I->grabTextFrom(Administrator\MenuItem::$selectOption);
            $I->selectOption(Administrator\MenuItem::$menuDropDown, $option);


            /**
             * save the menu item
             */
            $I->click(Administrator\MenuItem::$saveButton);

            /**
             * success message
             */
            $I->see(Administrator\MenuItem::$successMessage, Administrator\AdminPage::$systemMessageContainer);
        }

        public function trashMenuItems(\AcceptanceTester $I){
            $I->comment('I am going to unpublish a menu');
            $I->doAdministratorLogin();

            $I->amOnPage(MenuPage::$url);
            $I->checkForPhpNoticesOrWarnings();

            $I->click(MenuPage::$menuSelect);

            $I->click(MenuPage::$checkAll);

            $I->clickToolbarButton('trash');

        }

    }

