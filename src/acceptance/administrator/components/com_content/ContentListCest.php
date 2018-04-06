<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Step\Acceptance\Administrator\Admin;
use Page\Acceptance\Administrator\Components\Content\ContentFormPage;
use Page\Acceptance\Administrator\Components\Content\ContentListPage;

/**
 * Tests for com_content list view
 */
class ContentListCest
{
	const ARTICLE_STATE_ALL= '*';
	const ARTICLE_STATE_NONE = null;
	const ARTICLE_STATE_TRASHED = -2;
	const ARTICLE_STATE_UNPUBLISHED = 0;
	const ARTICLE_STATE_PUBLISHED = 1;
	const ARTICLE_STATE_ARCHIVED = 2;

	const ARTICLE_STATE_FEATURED = 1;
	const ARTICLE_STATE_UNFEATURED = 0;

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
	 * @param Admin $I
	 */
	public function openCreateNewArticleFormUsingToolbarButton(Admin $I)
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
	 * @param Admin $I
	 */
	public function seeArticlesInList(Admin $I)
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
	 * @param Admin $I
	 */
	public function publishArticleUsingToolbarButton(Admin $I)
	{
		$I->wantToTest('that its possible to publish an article using the toolbar publish button');

		$testArticle = $this->article(['state' => self::ARTICLE_STATE_UNPUBLISHED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->selectItemFromList($testArticle['title']);
		$I->clickToolbarButton('publish');
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => self::ARTICLE_STATE_PUBLISHED]));
		$I->seeSystemMessage('1 article published.');
	}

	/**
	 * Test publish an article using the inline publish button
	 *
	 * @param Admin $I
	 */
	public function publishArticleUsingInlineButton(Admin $I)
	{
		$I->wantToTest('that its possible to publish an article using the inline publish button');

		$testArticle = $this->article(['state' => self::ARTICLE_STATE_UNPUBLISHED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->click(ContentListPage::itemPublishButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => self::ARTICLE_STATE_PUBLISHED]));
		$I->seeSystemMessage('1 article published.');
	}

	/**
	 * Test unpublish an article using the toolbar publish button
	 *
	 * @param Admin $I
	 */
	public function unpublishArticleUsingToolbarButton(Admin $I)
	{
		$I->wantToTest('that its possible to unpublish an article using the toolbar publish button');

		$testArticle = $this->article(['state' => self::ARTICLE_STATE_PUBLISHED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->selectItemFromList($testArticle['title']);
		$I->clickToolbarButton('unpublish');
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => self::ARTICLE_STATE_UNPUBLISHED]));
		$I->seeSystemMessage('1 article unpublished.');
	}

	/**
	 * Test unpublish an article using the inline publish button
	 *
	 * @param Admin $I
	 */
	public function unpublishArticleUsingInlineButton(Admin $I)
	{
		$I->wantToTest('that its possible to unpublish an article using the inline publish button');

		$testArticle = $this->article(['state' => self::ARTICLE_STATE_PUBLISHED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->click(ContentListPage::itemUnPublishButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => self::ARTICLE_STATE_UNPUBLISHED]));
		$I->seeSystemMessage('1 article unpublished.');
	}

	/**
	 * Test feature article using toolbar button
	 *
	 * @param Admin $I
	 */
	public function featureArticledUsingToolbarButton(Admin $I)
	{
		$I->wantToTest('that it is possible to feature an article using toolbar button.');

		$testArticle = $this->article(['featured' => self::ARTICLE_STATE_UNFEATURED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->selectItemFromList($testArticle['title']);
		$I->clickToolbarButton('feature');
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['featured' => self::ARTICLE_STATE_FEATURED]));
		$I->seeSystemMessage('1 article featured.');
	}

	/**
	 * Test feature article using inline button
	 *
	 * @param Admin $I
	 */
	public function featureArticledUsingInlineButton(Admin $I)
	{
		$I->wantToTest('that it is possible to feature an article using inline button.');

		$testArticle = $this->article(['featured' => self::ARTICLE_STATE_UNFEATURED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->click(ContentListPage::itemFeatureButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['featured' => self::ARTICLE_STATE_FEATURED]));
		$I->seeSystemMessage('1 article featured.');
	}

	/**
	 * Test feature article using toolbar button
	 *
	 * @param Admin $I
	 */
	public function unfeatureArticledUsingToolbarButton(Admin $I)
	{
		$I->wantToTest('that it is possible to unfeature an article using toolbar button.');

		$testArticle = $this->article(['featured' => self::ARTICLE_STATE_FEATURED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->selectItemFromList($testArticle['title']);
		// TODO add this method to JoomlaBrowser::clickToolbarButton('unfeatured')
		$I->click(['id' => "toolbar-unfeatured"]);
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['featured' => self::ARTICLE_STATE_UNFEATURED]));
		$I->seeSystemMessage('1 article unfeatured.');
	}

	/**
	 * Test feature article using inline button
	 *
	 * @param Admin $I
	 */
	public function unfeatureArticledUsingInlineButton(Admin $I)
	{
		$I->wantToTest('that it is possible to unfeature an article using inline button.');

		$testArticle = $this->article(['featured' => self::ARTICLE_STATE_FEATURED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->click(ContentListPage::itemUnFeatureButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['featured' => self::ARTICLE_STATE_UNFEATURED]));
		$I->seeSystemMessage('1 article unfeatured.');
	}

	/**
	 * Test archive article using toolbar button
	 *
	 * @param Admin $I
	 */
	public function archiveArticledUsingToolbarButton(Admin $I)
	{
		$I->wantToTest('that it is possible to archive an article using toolbar button.');

		$testArticle = $this->article(['state' => self::ARTICLE_STATE_PUBLISHED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->selectItemFromList($testArticle['title']);
		$I->clickToolbarButton('archive');
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => self::ARTICLE_STATE_ARCHIVED]));
		$I->seeSystemMessage('1 article archived.');
		$I->dontSeeElement(ContentListPage::item($testArticle['title']));
	}

	/**
	 * Test publish archived article using inline buttons
	 *
	 * @param Admin $I
	 */
	public function publishArchivedArticledUsingInlineButtons(Admin $I, ContentListPage $contentListPage)
	{
		$I->wantToTest('that it is possible to archive an article using toolbar button.');

		$testArticle = $this->article(['state' => self::ARTICLE_STATE_ARCHIVED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->dontSeeElement(ContentListPage::item($testArticle['title']));
		$contentListPage->openTableOptions();
		$contentListPage->filterByState();
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->selectItemFromList($testArticle['title']);
		$I->click(ContentListPage::itemUnArchiveButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => self::ARTICLE_STATE_UNPUBLISHED]));
		$I->seeSystemMessage('1 article unpublished.');
		$I->dontSeeElement(ContentListPage::item($testArticle['title']));
		$I->openTableOptions();
		$I->filterByState(null);
	}
	// TODO unArchiveArticle

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

	public function ArticleOld(Admin $I)
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
			'state'     => self::ARTICLE_STATE_PUBLISHED,
			'created'   => $now,
			'images'    => '',
			'urls'      => '',
			'attribs'   => '',
			'metakey'   => '',
			'metadesc'  => '',
			'metadata'  => '',
			'featured'  => self::ARTICLE_STATE_UNFEATURED,
			'language'  => '*'
		];

		return array_merge($default, $attributes);
	}
}
