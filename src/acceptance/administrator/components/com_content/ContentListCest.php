<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Page\Acceptance\Administrator\Components\Content\ContentFormPage;
use Page\Acceptance\Administrator\Components\Content\ContentListPage;
use Step\Acceptance\Administrator\Admin;

/**
 * Tests for com_content list view
 */
class ContentListCest
{
	const ARTICLE_STATE_ALL = '*';
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
		$I->amOnPage(ContentListPage::$url);
		$I->clickToolbarButton('new');
		$I->seeInCurrentUrl(ContentFormPage::$url);
	}

	/**
	 * Test edit an arcticle using link
	 *
	 * @param Admin $I
	 */
	public function openEditArticleFormUsingLink(Admin $I)
	{
		$testArticle = $this->article();
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->click($testArticle['title']);
		$I->seeInCurrentUrl(ContentFormPage::$url);
		$I->seeInField(ContentFormPage::formFieldName('title'), $testArticle['title']);
		$I->seeInField(ContentFormPage::formFieldName('alias'), $testArticle['alias']);
	}

	/**
	 * Test display articles
	 *
	 * @param Admin $I
	 */
	public function seeArticlesInList(Admin $I)
	{
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
	 * @param Admin           $I
	 * @param ContentListPage $contentListPage
	 */
	public function publishArticleUsingToolbarButton(Admin $I, ContentListPage $contentListPage)
	{
		$testArticle = $this->article(['state' => self::ARTICLE_STATE_UNPUBLISHED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$contentListPage->selectItemFromList($testArticle['title']);
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
	 * @param Admin           $I
	 * @param ContentListPage $contentListPage
	 */
	public function unpublishArticleUsingToolbarButton(Admin $I, ContentListPage $contentListPage)
	{
		$testArticle = $this->article(['state' => self::ARTICLE_STATE_PUBLISHED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$contentListPage->selectItemFromList($testArticle['title']);
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
	 * @param Admin           $I
	 * @param ContentListPage $contentListPage
	 */
	public function featureArticledUsingToolbarButton(Admin $I, ContentListPage $contentListPage)
	{
		$testArticle = $this->article(['featured' => self::ARTICLE_STATE_UNFEATURED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$contentListPage->selectItemFromList($testArticle['title']);
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
	 * @param Admin           $I
	 * @param ContentListPage $contentListPage
	 */
	public function unfeatureArticledUsingToolbarButton(Admin $I, ContentListPage $contentListPage)
	{
		$testArticle = $this->article(['featured' => self::ARTICLE_STATE_FEATURED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$contentListPage->selectItemFromList($testArticle['title']);
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
	 * @param Admin           $I
	 * @param ContentListPage $contentListPage
	 */
	public function archiveArticledUsingToolbarButton(Admin $I, ContentListPage $contentListPage)
	{
		$testArticle = $this->article(['state' => self::ARTICLE_STATE_PUBLISHED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$contentListPage->selectItemFromList($testArticle['title']);
		$I->clickToolbarButton('archive');
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => self::ARTICLE_STATE_ARCHIVED]));
		$I->seeSystemMessage('1 article archived.');
		$I->dontSeeElement(ContentListPage::item($testArticle['title']));
	}

	/**
	 * Test publish archived article using inline buttons
	 *
	 * @param Admin           $I
	 * @param ContentListPage $contentListPage
	 */
	public function publishArchivedArticledUsingInlineButtons(Admin $I, ContentListPage $contentListPage)
	{
		$testArticle = $this->article(['state' => self::ARTICLE_STATE_ARCHIVED]);
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->dontSeeElement(ContentListPage::item($testArticle['title']));
		$contentListPage->openTableOptions();
		$contentListPage->filterByState(self::ARTICLE_STATE_ARCHIVED);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$contentListPage->selectItemFromList($testArticle['title']);
		$I->click(ContentListPage::itemUnArchiveButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => self::ARTICLE_STATE_UNPUBLISHED]));
		$I->seeSystemMessage('1 article unpublished.');
		$I->dontSeeElement(ContentListPage::item($testArticle['title']));
		$contentListPage->filterByState(self::ARTICLE_STATE_NONE);
		$I->seeElement(ContentListPage::item($testArticle['title']));
		$I->click(ContentListPage::itemPublishButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, ['state' => self::ARTICLE_STATE_PUBLISHED]));
		$I->seeSystemMessage('1 article published.');
	}

	/**
	 * Test check an article in using toolbar button
	 *
	 * @param Admin           $I
	 * @param ContentListPage $contentListPage
	 */
	public function checkAnArticleInUsingToolbarButton(Admin $I, ContentListPage $contentListPage)
	{
		$testArticle = $this->article();
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->click($testArticle['title']);
		$I->seeInCurrentUrl(ContentFormPage::$url);
		$I->amOnPage(ContentListPage::$url);
		$I->dontseeInDatabase($this->tableName, array_merge($testArticle, [
			'checked_out'      => 0,
			'checked_out_time' => '0000-00-00 00:00:00',
		]));
		$I->seeElement(ContentListPage::itemCheckinButton($testArticle['title']));
		$contentListPage->selectItemFromList($testArticle['title']);
		// TODO fix typo in JoomlaBrowser
		$I->click(['id' => 'toolbar-checkin']);
		$I->dontSeeElement(ContentListPage::itemCheckinButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, [
			'checked_out'      => 0,
			'checked_out_time' => '0000-00-00 00:00:00',
		]));
	}

	/**
	 * Test check an article in using inline button
	 *
	 * @param Admin           $I
	 * @param ContentListPage $contentListPage
	 */
	public function checkAnArticleInUsingInlineButton(Admin $I, ContentListPage $contentListPage)
	{
		$testArticle = $this->article();
		$I->haveInDatabase($this->tableName, $testArticle);

		$I->amOnPage(ContentListPage::$url);
		$I->click($testArticle['title']);
		$I->seeInCurrentUrl(ContentFormPage::$url);
		$I->amOnPage(ContentListPage::$url);
		$I->dontseeInDatabase($this->tableName, array_merge($testArticle, [
			'checked_out'      => 0,
			'checked_out_time' => '0000-00-00 00:00:00',
		]));
		$I->click(ContentListPage::itemCheckinButton($testArticle['title']));
		$I->dontSeeElement(ContentListPage::itemCheckinButton($testArticle['title']));
		$I->seeInDatabase($this->tableName, array_merge($testArticle, [
			'checked_out'      => 0,
			'checked_out_time' => '0000-00-00 00:00:00',
		]));
	}

	/**
	 * Test change language of multiple articles
	 *
	 * @param Admin           $I
	 * @param ContentListPage $contentListPage
	 */
	public function batchChangeLanguageOfMultipleArticles(Admin $I, ContentListPage $contentListPage)
	{
		$changeToLanguage = 'en-GB';

		$testArticle1 = $this->article(['title' => 'Test Article 1', 'alias' => 'test-article-1', 'language' => '*']);
		$testArticle2 = $this->article(['title' => 'Test Article 2', 'alias' => 'test-article-2', 'language' => '*']);
		$I->haveInDatabase($this->tableName, $testArticle1);
		$I->haveInDatabase($this->tableName, $testArticle2);

		$I->amOnPage(ContentListPage::$url);
		$contentListPage->selectItemFromList($testArticle1['title']);
		$contentListPage->selectItemFromList($testArticle2['title']);
		// TODO fix in JoomlaBrowser
		$I->click('Batch', ['css' => '.btn-toolbar.d-flex']);
		$I->wait(1); // Wait for the modal become visible
		// TODO move locators to page object
		$I->selectOption('batch[language_id]', $changeToLanguage);
		$I->click('Process');
		$I->seeInDatabase($this->tableName,  array_merge( $testArticle1, ['language' => $changeToLanguage]));
		$I->seeInDatabase($this->tableName,  array_merge( $testArticle2, ['language' => $changeToLanguage]));
	}

	// TODO add Tags to multiple articles

	// TODO change access level of multiple articles

	// TODO trash an article using toolbar button

	// TODO open article configuration

	// TODO open article help

	// Change order of articles

	// Test toolbar options without selection

	// TODO batch toollbar options with only one selection

	// Search articles
	// Search by id
	// Search by author

	// Clear the search of articles

	// Sorting articles
	// id

	// Filter articles
	// status
	// category
	// user
	// tag

	// No matching results

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
