<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Page\Acceptance\Administrator\ContentFormPage;
use Page\Acceptance\Administrator\ContentListPage;

/**
 * Tests for com_content list view
 *
 * @since    __DEPLOY_VERSION__
 */
class ContentListCest
{
	/**
	 * The name of the com_content table
	 *
	 * @var string
	 */
	protected $tableName = '#__content';

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
		$I->amOnPage(ContentListPage::$url);
		$I->waitForElement(ContentListPage::$filterSearch);
		$I->checkForPhpNoticesOrWarnings();
	}

	/**
	 * Test create a new arcticle
	 *
	 * @param   \Step\Acceptance\Administrator\Content $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function openCreateNewArticleFormUsingToolbarButton(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that it is possible to open the create new article form using the "new" toolbar button.');
		$I->amOnPage(ContentListPage::$url);
		$I->waitForElement(ContentListPage::$pageTitle);
		$I->clickToolbarButton('new');
		$I->seeInCurrentUrl(ContentFormPage::$url);
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

		$testArticle = $this->article();
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->see($testArticle['title']);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->see('Alias: ' . $testArticle['alias']);
	}

	/**
	 * Test publish an article using the toolbar publish button
	 *
	 * @param   \Step\Acceptance\Administrator\Content $Iw
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function publishArticleUsingToolbarButton(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that its possible to publish an article using the toolbar publish button');

		$testArticle = $this->article(['state' => 0]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->selectItemFromList($testArticle['title']);
		$I->clickToolbarButton('publish');
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => 1]));
		$I->seeSystemMessage('1 article published.');
	}

	/**
	 * Test publish an article using the inline publish button
	 *
	 * @param   \Step\Acceptance\Administrator\Content $Iw
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function publishArticleUsingInlineButton(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that its possible to publish an article using the inline publish button');

		$testArticle = $this->article(['state' => 0]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->click(ContentListPage::itemPublishButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => 1]));
		$I->seeSystemMessage('1 article published.');
	}

	/**
	 * Test unpublish an article using the toolbar publish button
	 *
	 * @param   \Step\Acceptance\Administrator\Content $Iw
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function unpublishArticleUsingToolbarButton(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that its possible to unpublish an article using the toolbar publish button');

		$testArticle = $this->article(['state' => 1]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->selectItemFromList($testArticle['title']);
		$I->clickToolbarButton('unpublish');
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => 0]));
		$I->seeSystemMessage('1 article unpublished.');
	}

	/**
	 * Test unpublish an article using the inline publish button
	 *
	 * @param   \Step\Acceptance\Administrator\Content $Iw
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function unpublishArticleUsingInlineButton(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that its possible to unpublish an article using the inline publish button');

		$testArticle = $this->article(['state' => 1]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->click(ContentListPage::itemUnPublishButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => 0]));
		$I->seeSystemMessage('1 article unpublished.');
	}

	/**
	 * Test feature article using toolbar button
	 *
	 * @param   \Step\Acceptance\Administrator\Content $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function featureArticledUsingToolbarButton(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that it is possible to feature an article using toolbar button.');

		$testArticle = $this->article(['featured' => 0]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->selectItemFromList($testArticle['title']);
		$I->clickToolbarButton('feature');
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['featured' => 1]));
		$I->seeSystemMessage('1 article featured.');
	}

	/**
	 * Test feature article using inline button
	 *
	 * @param   \Step\Acceptance\Administrator\Content $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function featureArticledUsingInlineButton(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that it is possible to feature an article using inline button.');

		$testArticle = $this->article(['featured' => 0]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->click(ContentListPage::itemFeatureButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['featured' => 1]));
		$I->seeSystemMessage('1 article featured.');
	}

	/**
	 * Test feature article using toolbar button
	 *
	 * @param   \Step\Acceptance\Administrator\Content $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function unfeatureArticledUsingToolbarButton(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that it is possible to unfeature an article using toolbar button.');

		$testArticle = $this->article(['featured' => 1]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->selectItemFromList($testArticle['title']);
		// TODO add this method to JoomlaBrowser::clickToolbarButton('unfeatured')
		$I->click(['id' => "toolbar-unfeatured"]);
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['featured' => 0]));
		$I->seeSystemMessage('1 article unfeatured.');
	}

	/**
	 * Test feature article using inline button
	 *
	 * @param   \Step\Acceptance\Administrator\Content $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function unfeatureArticledUsingInlineButton(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that it is possible to unfeature an article using inline button.');

		$testArticle = $this->article(['featured' => 1]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->click(ContentListPage::itemUnFeatureButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['featured' => 0]));
		$I->seeSystemMessage('1 article unfeatured.');
	}

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

	public function ArticleOld(\Step\Acceptance\Administrator\Content $I)
	{
//		$I->setArticleAccessLevel($this->articleTitle, $this->articleAccessLevel);
//		$I->trashArticle($this->articleTitle);
	}

	/**
	 * Create an article
	 *
	 * @param array $attributes
	 *
	 * @return array
	 */
	protected function article(array $attributes = []): array
	{
		$now = (new DateTime())->format('Y-m-d H:i:s');

		$default = [
			'title'     => 'Test Article',
			'alias'     => 'test-article',
			'introtext' => 'Test Article Introtext',
			'fulltext'  => 'Test Article Fulltext',
			'state'     => 1,
			'created'   => $now,
			'images'    => '',
			'urls'      => '',
			'attribs'   => '',
			'metakey'   => '',
			'metadesc'  => '',
			'metadata'  => '',
			'featured'  => 0,
			'language'  => '*'
		];

		return array_merge($default, $attributes);
	}
}
