<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Page\Acceptance\Administrator\ArticleManagerPage;

/**
 * Article Tests
 */
class ArticleCest
{

	/**
	 * Titel of the dummy article
	 *
	 * @var string
	 */
	private $articleTitle = 'Article title';

	/**
	 * Content of the dummy article
	 *
	 * @var string
	 */
	private $articleContent = 'Article content';

	/**
	 * Accesss level of the dummy article
	 *
	 * @var string
	 */
	private $articleAccessLevel = 'Registered';

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
	public function createANewArticle(\Step\Acceptance\Administrator\Content $I)
	{
		$I->wantToTest('that it is possible to create a new article.');
		$I->createArticle($this->articleTitle, $this->articleContent);
	}

	public function Article(AcceptanceTester $I, $scenario)
	{
		$I = new ContentStep($scenario);

		$I->featureArticle($this->articleTitle);
		$I->setArticleAccessLevel($this->articleTitle, $this->articleAccessLevel);
		$I->unPublishArticle($this->articleTitle);
		$I->trashArticle($this->articleTitle);
	}
}
