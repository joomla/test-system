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
    use Page\Acceptance\Administrator;
    use Faker\Factory as fakerLib;

    class CategoryMenuCest
    {

        public function __construct()
        {

            $faker = fakerLib::create();

            $this->categoryTitle = $faker->name;
            $this->articleTitle = $faker->name;
            $this->articleContent = $faker->text;
            $this->menuItemName = $faker->name;
            $this->menuItemAlias = $faker->userName;

        }

        public function Category(\AcceptanceTester $I, $scenario)
        {

            $I = new CategoryStep($scenario);

            $I->doAdministratorLogin();
            $I->createContentCategory($this->categoryTitle);

        }

        public function createArticles(\AcceptanceTester $I, $scenario)
        {

            $I = new ContentStep($scenario);

            for ($j=0;$j<2;$j++) {
                $I->doAdministratorLogin();
                $I->createArticle($this->articleTitle.$j, $this->articleContent, $this->categoryTitle);
            }

        }

        public function createMenuForCategory(\AcceptanceTester $I)
        {

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


            $I->fillField(Administrator\MenuItem::$menuItemTitle, $this->menuItemName);
            $I->fillField(Administrator\MenuItem::$menuItemAlias, $this->menuItemAlias);

            $I->waitForText('Select');

            $I->click('Select');
            $I->checkForPhpNoticesOrWarnings();
            $I->switchToIFrame();
            $I->waitForElement(Administrator\MenuItem::$menuTypeModal, TIMEOUT);
            $I->switchToIFrame("Menu Item Type");
            $I->waitForElement(Administrator\MenuItem::$articlesLink, TIMEOUT);
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
            $I->selectOption(Administrator\MenuItem::$selectMenuType,$this->categoryTitle);

            //Select option from dropdown menu
            $I->click(Administrator\MenuItem::$menuDropDown);
            $option = $I->grabTextFrom(Administrator\MenuItem::$selectOption);
            $I->selectOption(Administrator\MenuItem::$menuDropDown, $option);

            //Save the menu item
            $I->click(Administrator\MenuItem::$dropDownToggle);
            $I->clickToolbarButton('save & close');

            // Success message
            $I->see(Administrator\MenuItem::$successMessage, Administrator\AdminPage::$systemMessageContainer);

            $I->searchForItem($this->menuItemName);

        }

        public function unpublishMenuItems(\AcceptanceTester $I)
        {

            $I->comment('I am going to unpublish a menu');
            $I->doAdministratorLogin();

            $I->amOnPage(Administrator\MenuItem::$url);
            $I->checkForPhpNoticesOrWarnings();

            //Select 'Main Menu'
            $I->click(Administrator\MenuItem::$selectMenu);
            $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
            $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

            //Search For Menu Item
            $I->searchForItem($this->menuItemName);
            $I->click(Administrator\MenuItem::$check);

            $I->clickToolbarButton('unpublish');

        }

        public function checkInFrontEndUnpublish(\AcceptanceTester $I)
        {

            $I->comment('Make sure the menu item is not on site After unpublishing it');
            $I->amOnPage(Administrator\frontEnd::$urlfront);

            $I->dontSee($this->menuItemName);

        }

        public function publishMenuItems(\AcceptanceTester $I)
        {

            $I->comment('I am going to publish a menu');
            $I->doAdministratorLogin();

            $I->amOnPage(Administrator\MenuItem::$url);
            $I->checkForPhpNoticesOrWarnings();

            //Set Menu To 'Main Menu'
            $I->click(Administrator\MenuItem::$selectMenu);
            $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
            $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

            //Search for Menu item
            $I->searchForItem($this->menuItemName);
            $I->click(Administrator\MenuItem::$check);

            //publish
            $I->clickToolbarButton('publish');

        }

        public function checkInFrontEndPublish(\AcceptanceTester $I)
        {

            $I->comment('Check the menu item on site After publishing it');
            $I->amOnPage(Administrator\frontEnd::$urlfront);

            $I->see($this->menuItemName);

        }

        public function setMenuItemHome(\AcceptanceTester $I)
        {

            $I->comment('I am going to set a menu item home');
            $I->doAdministratorLogin();

            $I->amOnPage(Administrator\MenuItem::$url);

            //Set Menu To 'Main Menu'
            $I->click(Administrator\MenuItem::$selectMenu);
            $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
            $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

            //Search for Menu item
            $I->searchForItem($this->menuItemName);
            $I->click(Administrator\MenuItem::$check);

            //Set To Home
            $I->click(Administrator\MenuItem::$homeButton);

        }

        public function checkInFrontEndSetHome(\AcceptanceTester $I)
        {

            $I->comment('Check the menu item on site After setting it to Home');
            $I->amOnPage(Administrator\frontEnd::$urlfront);

            $I->see($this->menuItemName);

        }

        public function rebuildMenuItems(\AcceptanceTester $I)
        {

            $I->comment('I am going to rebuild a menu item');
            $I->doAdministratorLogin();

            $I->amOnPage(Administrator\MenuItem::$url);
            $I->checkForPhpNoticesOrWarnings();

            //Set Menu To 'Main Menu'
            $I->click(Administrator\MenuItem::$selectMenu);
            $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
            $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

            //Search for Menu item
            $I->searchForItem($this->menuItemName);
            $I->click(Administrator\MenuItem::$check);

            $I->clickToolbarButton('rebuild');

            // Success message
            $I->see('Menu items list rebuilt', Administrator\AdminPage::$systemMessageContainer);

        }

        public function checkInFrontEndRebuild(\AcceptanceTester $I)
        {

            $I->comment('Check the menu item on site After rebuilding');
            $I->amOnPage(Administrator\frontEnd::$urlfront);

            $I->see($this->menuItemName);

        }

        public function trashMenuItems(\AcceptanceTester $I)
        {

            $I->comment('I am going to trash a menu item');
            $I->doAdministratorLogin();

            $I->amOnPage(Administrator\MenuItem::$url);
            $I->checkForPhpNoticesOrWarnings();

            //Set Menu To 'Main Menu'
            $I->click(Administrator\MenuItem::$selectMenu);
            $option = $I->grabTextFrom(Administrator\MenuItem::$selectMainMenu);
            $I->selectOption(Administrator\MenuItem::$selectMenu, $option);

            //Set 'Home' To Home To Trash
            $I->searchForItem('Home');
            $I->click(Administrator\MenuItem::$check);
            $I->click(Administrator\MenuItem::$homeButton);

            //Search for Menu item
            $I->searchForItem($this->menuItemName);
            $I->click(Administrator\MenuItem::$check);

            $I->clickToolbarButton('trash');

            $I->see('1 menu item trashed.', Administrator\AdminPage::$systemMessageContainer);
        }

        public function checkInFrontEndTrash(\AcceptanceTester $I)
        {

            $I->comment('Check the menu item on site After rebuilding');
            $I->amOnPage(Administrator\frontEnd::$urlfront);

            $I->dontSee($this->menuItemName);

        }

    }
