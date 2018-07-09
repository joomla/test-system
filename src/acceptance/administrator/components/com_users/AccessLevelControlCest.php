<?php
/**
     * @package     Joomla.Tests
     * @subpackage  Acceptance.tests
     *
     * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
     * @license     GNU General Public License version 2 or later; see LICENSE.txt
     */
use Page\Acceptance\Administrator\AccessLevelControlFormPage;
use Page\Acceptance\Administrator\AccessLevelControlListPage;
use Page\Acceptance\Site\FrontPage;
use Step\Acceptance\Administrator\Category as CategoryStep;
use Step\Acceptance\Administrator\Content as ContentStep;
use Step\Acceptance\Administrator\MenuItemStep;

/**
 * Administrator Access Level Control Tests
 *
 * @category  Users
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @since     4.0.0
 */
class AccessLevelControlCest
{
    public function __construct()
    {
        $this->username = "testUser";
        $this->password = "test";
        $this->name = "Test Bot";
        $this->email = "Testbot@example.com";
        $this->categoryTitle = 'Google Summer Of Codes Category';
        $this->articleTitle = 'Joomla CMS Organisation';
        $this->articleContent = 'Joomla is an open source content management system';
        $this->menuItemName = 'Joomla CMS';
        $this->menuItemAlias = 'joomla';
    }
    /**
     * Create Category
     *
     * @param   \AcceptanceTester $I         The Acceptance Tester object
     * @param   string            $scenario  Scenario
     * @return  void
     */
    public function Category(\AcceptanceTester $I, $scenario)
    {
        $I = new CategoryStep($scenario);

        $I->doAdministratorLogin();
        $I->createContentCategory($this->categoryTitle);

        $I->amOnPage(AccessLevelControlListPage::$categoryUrl);
        $I->searchForItem($this->categoryTitle);
        $I->click($this->categoryTitle);
        $I->click('Permissions');
        // Only visible for Admin and SuperUser
        // Deny Manager all rights
        $I->click('Manager');
        $I->selectOption(AccessLevelControlFormPage::$managerCreateSelect,'Denied');
        $I->selectOption(AccessLevelControlFormPage::$managerDeleteSelect,'Denied');
        $I->selectOption(AccessLevelControlFormPage::$managerEditSelect,'Denied');
        $I->selectOption(AccessLevelControlFormPage::$managerEditStateSelect,'Denied');
        $I->selectOption(AccessLevelControlFormPage::$managerEditOwnSelect,'Denied');
        // Allow Author delete, edit and edit select
        $I->click('Author');
        $I->selectOption(AccessLevelControlFormPage::$authorDeleteSelect,'Allowed');
        $I->selectOption(AccessLevelControlFormPage::$authorEditSelect,'Allowed');
        $I->selectOption(AccessLevelControlFormPage::$authorEditStateSelect,'Allowed');
        // save & close
        $I->click(AccessLevelControlFormPage::$dropDownToggle);
        $I->clickToolbarButton('save & close');

    }

    /**
     * Create 2 Articles in Category
     *
     * @param   \AcceptanceTester  $I          Acceptance Tester
     * @param   string             $scenario   Scenario
     *
     * @return void
     */
    public function createArticles(\AcceptanceTester $I, $scenario)
    {
        $I = new ContentStep($scenario);

        for ($j=0;$j<2;$j++)
        {
            $I->doAdministratorLogin();
            $I->createArticle($this->articleTitle . $j, $this->articleContent, $this->categoryTitle);
        }
    }

    /**
     * Creates a menu item
     *
     * @param   MenuItemStep  $I
     *
     * @throws \Exception
     * @since  4.0.0
     * @return void
     */
    public function menuItem(MenuItemStep $I)
    {
        // Call Step function to create Menu item
        $I->menuItem($this->menuItemName, $this->menuItemAlias, $this->categoryTitle, 'Articles', 'Category Blog');
    }

    /**
     * Assign User Author Group
     *
     * @param   \AcceptanceTester  $I The AcceptanceTester Object
     *
     * @since   4.0.0
     *
     * @return  void
     */
    public function assignUserAuthor(\AcceptanceTester $I)
    {
        $I->doAdministratorLogin();
        $I->amOnPage(AccessLevelControlListPage::$url);
        $I->searchForItem($this->username);
        $I->click($this->name);
        // Assign User Groups
        $I->click('Assigned User Groups');
        $I->click(AccessLevelControlFormPage::$groupAuthor);
        // save & close
        $I->click(AccessLevelControlFormPage::$dropDownToggle);
        $I->clickToolbarButton('save & close');
        // Assertion
        $I->doFrontEndLogin($this->username,$this->password);
        $I->click($this->menuItemName);
        $I->see($this->articleTitle.'0');
        $I->click(FrontPage::$articleSettings);
        $I->click(FrontPage::$editArticle);
        $I->click(FrontPage::$toggleEditor);
        $I->fillField(FrontPage::$articleText,"This is editted text");
        $I->click(FrontPage::$saveArticle);
    }

    /**
     * Assign User Manager Group
     *
     * @param   \AcceptanceTester  $I The AcceptanceTester Object
     *
     * @since   4.0.0
     *
     * @return  void
     */
    public function assignUserManager(\AcceptanceTester $I)
    {
        $I->doAdministratorLogin();
        $I->amOnPage(AccessLevelControlListPage::$url);
        $I->searchForItem($this->username);
        $I->click($this->name);
        // Assign User Groups
        $I->click('Assigned User Groups');
        // uncheck Author
        $I->click(AccessLevelControlFormPage::$groupAuthor);
        // check Manager
        $I->click(AccessLevelControlFormPage::$groupManager);
        // save & close
        $I->click(AccessLevelControlFormPage::$dropDownToggle);
        $I->clickToolbarButton('save & close');
        // Assertion
        $I->doFrontEndLogin($this->username,$this->password);
        $I->click($this->menuItemName);
        $I->see($this->articleTitle.'0');
        $I->click(FrontPage::$articleSettings);
        $I->dontSeeElement(FrontPage::$editArticle);
    }
}
