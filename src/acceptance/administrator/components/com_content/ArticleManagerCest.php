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

		$testArticle = [
			'title'     => 'Test Article',
			'alias'     => 'test-article',
			'state'     => 1,
		];
		$I->haveInDatabase('content', $testArticle);

		$I->amOnPage(ArticleManagerPage::$url);
		$I->see($testArticle['title']);
		$I->see('Alias: ' . $testArticle['alias']);
	}

	// TODO publish article using toolbar button
	// TODO publish article using inline button
	// TODO unpublish article using toolbar button
	// TODO unpublish article using inline button

	/**
	 * Test feature articles
	 *
	 * @param   \Step\Acceptance\Administrator\Content $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
//	public function markArticleAsFeaturedUsingToolbarButton(\Step\Acceptance\Administrator\Content $I)
//	{
//		$I->wantToTest('that it is possible to mark an article as featured using toolbar button.');
//
//		$testArticle = [
//			'title'     => 'Test Article',
//			'alias'     => 'test-article',
//			'introtext' => 'Test Article Introtext',
//			'fulltext'  => 'Test Article Fulltext',
//			'state'     => 1,
//			'featured'  => 0
//		];
//		$I->haveInDatabase('content', $testArticle);
//
//		$I->amOnPage(ArticleManagerPage::$url);
//		$I->see($testArticle['title']);
//		$I->see('Alias: ' . $testArticle['alias']);
//	}

	// TODO Feature article using inline button
	// TODO Unfeature article using toolbar button
	// TODO Unfeature article using inline button

	// TODO archive an article

	// TODO check an article in

	// TODO changeLanguageOfMultipleArticles

	// TODO add Tags to multiple articles

	// TODO change access level of multiple articles

	// TODO trash an article using toolbar button

	// TODO open article configuration

	// TODO open article help

	// Change order of articles

	// Search articles
	// Clear the search of articles

	// Sorting articles
	// id

	// Filter articles
	// status
	// category
	// user
	// tag

	// Change limit of articles

	// Paginate articles

	public function Article(\Step\Acceptance\Administrator\Content $I)
	{
//		$I->featureArticle($this->articleTitle);
//		$I->setArticleAccessLevel($this->articleTitle, $this->articleAccessLevel);
//		$I->unPublishArticle($this->articleTitle);
//		$I->trashArticle($this->articleTitle);
	}
}
