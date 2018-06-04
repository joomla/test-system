<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace administrator\components\com_menu_article;
use Step\Acceptance\Administrator\Content as ContentStep;
use Page\Acceptance\Administrator;
use Faker\Factory as fakerLib;

/**
 * Class ArticleMenuCest
 *
 * @category  Menu_Article
 * @package   Administratorcomponentscom_Menu_Article
 * @author    Samarth<samarthsharma351@gmail.com>
 * @copyright 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license   Joomla 2005-2018
 * @link      ArticleMenuCest
 */
class ArticleMenuCest
{
        public function __construct()
        {
                $faker = fakerLib::create();
                $this->articleTitle = $faker->name;
                $this->articleContent = $faker->text;
                $this->menuItemName = $faker->name;
                $this->menuItemAlias = $faker->userName;
        }
        /**
         * Article is created
         *
         * @param \AcceptanceTester $I
         * @param string            $scenario Scenario
         *
         * @return void
         */
        public function Article(\AcceptanceTester $I, $scenario)
        {
                $I = new ContentStep($scenario);
                $I->doAdministratorLogin();
                $I->createArticle($this->articleTitle, $this->articleContent, 'SamSham');
        }
        /**
         * Create Menu For Article
         *
         * @param \AcceptanceTester $I
         *
         * @throws \Exception
         *
         * @return void
         */
        public function createMenuForArticle(\AcceptanceTester $I)
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
            /*
                $I->waitForElement( "//div[contains(text(), 'Single Article')]", TIMEOUT);
                $I->scrollTo("//div[contains(text(), 'Single Article')]");
                $I->click("//div[contains(text(), 'Single Article')]");

                $I->click(Administrator\MenuItem::$select);

                $I->switchToIFrame('Select or Change article');
            
                //Search for item
                $I->wait(1);
                // The below line of code is to select Article
                //$I->click(['link' => $this->articleTitle]);
                $I->click(['xpath' => '//a[contains(text(),\''.$this->articleTitle.'\')]']);
                */

                $I->wait(.5);
                $I->waitForElement( "//div[contains(text(), 'Archived Articles')]", TIMEOUT);
                $I->scrollTo("//div[contains(text(), 'Archived Articles')]");
                $I->click("//div[contains(text(), 'Archived Articles')]");

                //Select Option
                $I->selectOption(['id' => 'jform_request_catid'],'SamSham');

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

    }
