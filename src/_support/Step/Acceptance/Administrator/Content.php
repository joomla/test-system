<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Step
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Step\Acceptance\Administrator;

use Page\Acceptance\Administrator\ArticleManagerPage;

/**
 * Acceptance Step object class contains suits for Content Manager.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class Content extends Admin
{

	public function createArticle($title, $body, $category)
	{
		$I = $this;
		$I->amOnPage(ArticleManagerPage::$url);
		$I->waitForElement(ArticleManagerPage::$filterSearch, TIMEOUT);
		$I->clickToolbarButton('New');
		$this->articleManagerPage->fillContentCreateForm($title, $body);
        if($category!='null'){
            $I->click(ArticleManagerPage::$selectCategory);
            $I->fillField(ArticleManagerPage::$fillCategory,$category);
        }
		$I->click(ArticleManagerPage::$dropDownToggle);
		$I->clickToolbarButton('Save & Close');
		$I->articleManagerPage->seeItemIsCreated($title);
	}

	public function featureArticle($title)
	{
		$I = $this;
		$I->amOnPage(ArticleManagerPage::$url);
		$I->waitForElement(ArticleManagerPage::$filterSearch, TIMEOUT);
		$I->searchForItem($title);
		$I->checkAllResults();
		$I->clickToolbarButton('feature');
		$I->seeNumberOfElements(ArticleManagerPage::$seeFeatured, 1);
	}

	public function setArticleAccessLevel($title, $accessLevel)
	{
		$I = $this;
		$I->amOnPage(ArticleManagerPage::$url);
		$I->waitForElement(ArticleManagerPage::$filterSearch, TIMEOUT);
		$I->searchForItem($title);
		$I->checkAllResults();
		$I->click($title);
		$I->waitForElement(['id' => "jform_access"], TIMEOUT);
		$I->selectOption(['id' => "jform_access"], $accessLevel);
		$I->click(ArticleManagerPage::$dropDownToggle);
		$I->clickToolbarButton('Save & Close');
		$I->waitForElement(ArticleManagerPage::$filterSearch, TIMEOUT);
		$I->see($accessLevel, ArticleManagerPage::$seeAccessLevel);
	}

	public function unPublishArticle($title)
	{
		$I = $this;
		$I->amOnPage(ArticleManagerPage::$url);
		$I->waitForElement(ArticleManagerPage::$filterSearch, TIMEOUT);
		$I->searchForItem($title);
		$I->checkAllResults();
		$I->clickToolbarButton('unpublish');
		$I->seeNumberOfElements(ArticleManagerPage::$seeUnpublished, 1);
	}

	public function trashArticle($title)
	{
		$I = $this;
		$I->amOnPage(ArticleManagerPage::$url);
		$I->waitForElement(ArticleManagerPage::$filterSearch, TIMEOUT);
		$this->articleManagerPage->haveItemUsingSearch($title);
		$I->clickToolbarButton('trash');
		$I->searchForItem($title);
		$I->dontSee($title);
	}
}
