<?php
    /**
     * @package     Joomla.Tests
     * @subpackage  Acceptance.tests
     *
     * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
     * @license     GNU General Public License version 2 or later; see LICENSE.txt
     */
    namespace administrator\components\com_category_menu;
    use Step\Acceptance\Administrator\Admin;
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
            $this->menuItemAlias = $faker->name;
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
                $I->createArticle($this->articleTitle, $this->articleContent, $this->categoryTitle);
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
             * List All Categories
             * Single Article  <- We chose this Option
             */
            $I->wait(.5);
            $I->waitForElement( "//div[contains(text(), 'Category Blog')]", TIMEOUT);
            $I->scrollTo("//div[contains(text(), 'Category Blog')]");
            $I->click("//div[contains(text(), 'Category Blog')]");

            //Select Category
            $I->click(Administrator\MenuItem::$select);

            //The below line of code is to select category
            $I->click(['xpath' => '//a[contains(text(),\''.$this->categoryTitle.'\')]']);
            
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

            $I->searchForItem($this->menuItemName);

        }
    }
