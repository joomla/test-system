<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Step\Acceptance\Administrator\Content as ContentStep;
use Page\Acceptance\Administrator\ArticleManagerPage;

class ArticleCest
{
	public function __construct()
	{
		$this->articleTitle = 'Article title';
		$this->articleContent = 'Article content';
		$this->articleAccessLevel = "Registered";
	}

	public function _before(AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
	}

	public function Article(AcceptanceTester $I, $scenario)
	{
		$I = new ContentStep($scenario);
		$I->createArticle($this->articleTitle, $this->articleContent, 'null');
		$I->featureArticle($this->articleTitle);
		$I->setArticleAccessLevel($this->articleTitle, $this->articleAccessLevel);
		$I->unPublishArticle($this->articleTitle);
		$I->trashArticle($this->articleTitle);
	}
}
