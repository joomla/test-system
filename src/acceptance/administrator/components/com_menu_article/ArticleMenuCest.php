<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Step\Acceptance\Administrator\Content as ContentStep;
use Step\Acceptance\Administrator\MenuItemStep as MenuItemStep;
use Page\Acceptance\Administrator\ContentListPage;
use Step\Acceptance\Site\FrontEnd;

/**
 * Class ArticleMenuCest
 *
 * @category  Menu_Article
 * @package   Administratorcomponentscom_Menu_Article
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @link      ArticleMenuCest
 * @since     4.0.0
 */
class ArticleMenuCest
{
	public function __construct()
	{
		$this->articleTitle = 'Test Article';
		$this->articleContent = 'This is to test article with menuitem';
		$this->menuItemName = 'Test Menu Item';
		$this->menuItemAlias = 'MenuItem';
	}

	/**
	 * Article is created
	 *
	 * @param   \AcceptanceTester   $I        Acceptance Tester
	 * @param   string              $scenario Scenario
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
	 * @param  MenuItemStep $I Acceptance Tester
	 *
	 * @return void
	 */
	public function createMenuForArticle(MenuItemStep $I)
	{
		$I->createMenuItem($this->menuItemName, $this->menuItemAlias, $this->articleTitle, 'Articles', 'Single Article');
	}

	/**
	 * Unpublish Article
	 *
	 * @param   \AcceptanceTester $I        Acceptance Tester
	 * @param   string            $scenario Scenario
	 *
	 * @return void
	 */
	public function unpublishArticleAssert(\AcceptanceTester $I, $scenario)
	{
		$I = new ContentStep($scenario);
		$I->doAdministratorLogin();
		// URL
		$I->amOnPage(ContentListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		// Unpublish
		$I->unPublishArticle($this->articleTitle);
		// Assertion
		$I->setFilter('select status', 'Unpublished');
		$I->searchForItem($this->articleTitle);
		$I->see($this->articleTitle);
		// FrontEnd Assertion
		$I = new FrontEnd($scenario);
        	$I->articleIsNotVisible($this->menuItemName, $this->articleTitle);
		$I->see('The requested page can\'t be found.');
	}

	/**
	 * Publish Article
	 *
	 * @param   \AcceptanceTester $I        Acceptance Tester
	 * @param   string            $scenario Scenario
	 *
	 * @return void
	 */
	public function publishArticleAssert(\AcceptanceTester $I, $scenario)
	{
		$I = new ContentStep($scenario);
		$I->doAdministratorLogin();
		// URL
		$I->amOnPage(ContentListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		// Publish
		$I->publishArticle($this->articleTitle);
		// Assertion
		$I->setFilter('select status', 'Published');
		$I->searchForItem($this->articleTitle);
		$I->see($this->articleTitle);
		// FrontEnd Assertion
		$I = new FrontEnd($scenario);
        	$I->articleIsVisible($this->menuItemName, $this->articleTitle);
	}

	/**
	 * Trash Article
	 *
	 * @param   \AcceptanceTester $I        Acceptance Tester
	 * @param   string            $scenario Scenario
	 *
	 * @return void
	 */
	public function trashArticleAssert(\AcceptanceTester $I, $scenario)
	{
		$I = new ContentStep($scenario);
		$I->doAdministratorLogin();
		// URL
		$I->amOnPage(ContentListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		// Trash
		$I->trashArticle($this->articleTitle);
		// Backend Assertion
		$I->setFilter('select status', 'Trashed');
		$I->searchForItem($this->articleTitle);
		$I->see($this->articleTitle);
		// FrontEnd Assertion
		$I = new FrontEnd($scenario);
        	$I->articleIsNotVisible($this->menuItemName, $this->articleTitle);
        	$I->see('The requested page can\'t be found.');
	}
}
