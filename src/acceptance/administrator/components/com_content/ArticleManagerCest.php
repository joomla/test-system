<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Page\Acceptance\Administrator\ArticleFormPage;
use Page\Acceptance\Administrator\ArticleManagerPage;

/**
 * Article Manager Tests
 *
 * @since    __DEPLOY_VERSION__
 */
class ArticleManagerCest
{
	/**
	 * Runs before every test
	 *
	 * @param AcceptanceTester $I
	 */
	public function _before(AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
	}

	/**
	 * Test that it loads without php notices and warnings.
	 *
	 * @param   AcceptanceTester $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function loadsWithoutPhpNoticesAndWarnings(AcceptanceTester $I)
	{
		$I->wantToTest('that it loads without php notices and warnings.');
		$I->amOnPage(ArticleManagerPage::$url);
		$I->waitForElement(ArticleManagerPage::$filterSearch);
		$I->checkForPhpNoticesOrWarnings();
	}

	/**
	 * Test create a new arcticle
	 *
	 * @param   \Step\Acceptance\Administrator\Content $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function createNewArticleUsingToolbarButton(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that it is possible to create a new articles using "new" toolbar button.');
		$I->amOnPage(ArticleManagerPage::$url);
		$I->waitForElement(ArticleManagerPage::$pageTitle);
		$I->clickToolbarButton('New');
		$I->seeInCurrentUrl(ArticleFormPage::$url);
	}

	/**
	 * Test display articles
	 *
	 * @param   \Step\Acceptance\Administrator\Content $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function seeArticlesInList(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that articles are displayed in the list.');

		$I->haveInDatabase('content', [
			'title'     => 'Test Article',
			'introtext' => 'Test Article Introtext',
			'fulltext'  => 'Test Article Fulltext',
			'state'     => 1,
		]);

		$I->amOnPage(ArticleManagerPage::$url);
		$I->see('Test Article');
	}

	public function Article(\Step\Acceptance\Administrator\Content $I)
	{
//		$I->featureArticle($this->articleTitle);
//		$I->setArticleAccessLevel($this->articleTitle, $this->articleAccessLevel);
//		$I->unPublishArticle($this->articleTitle);
//		$I->trashArticle($this->articleTitle);
	}
}
