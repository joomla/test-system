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
		$this->faker = Faker\Factory::create();
		$this->articleTitle = "Article One";
		$this->randomArticleTitle = $this->faker->bothify('ArticleCest ?##?');
		$this->randomArticleContent = $this->faker->bothify('Article Content ###?');
		$this->articleAccessLevel = "Registered";
	}

	public function _before(AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
	}

	public function Article(AcceptanceTester $I, $scenario)
	{
		$I = new ContentStep($scenario);
		$I->createArticle($this->randomArticleTitle, $this->randomArticleContent);
		$I->featureArticle($this->randomArticleTitle);
		$I->setArticleAccessLevel($this->randomArticleTitle, $this->articleAccessLevel);
		$I->unPublishArticle($this->randomArticleTitle);
		$I->trashArticle($this->randomArticleTitle);
	}
}
