<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Step
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Step\Acceptance\Administrator;

use Page\Acceptance\Administrator\ContentListPage;
use Page\Acceptance\Administrator;

/**
 * Acceptance Step object class contains suits for Content Manager.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    4.0.0
 */
class Content extends Admin
{
	/**
	 * Create A New Article
	 *
	 * @param   string  $title
	 *
	 * @since   4.0.0
	 */
	public function createArticle($title, $body, $category)
	{	
	   	$I = $this;
	   	$I->amOnPage(ContentListPage::$url);
	   	//$I->waitForElement(ArticleManagerPage::$filterSearch, TIMEOUT);
	   	$I->clickToolbarButton('new');
	   	ContentListPage::fillContentCreateForm($I,$title, $body);
	   	if($category != '')
		{
	   		$I->click(ContentListPage::$selectCategory);
	   		$I->fillField(ContentListPage::$fillCategory,$category);
	   		$I->pressKey(ContentListPage::$fillCategory,\Facebook\WebDriver\WebDriverKeys::ENTER);
	   	}
	   	$I->click(ContentListPage::$dropDownToggle);
	   	$I->clickToolbarButton('save & close');
	   	$I->searchForItem($title);
	}

	/**
	 * Helper function to feature an Article
	 *
	 * @param   string  $title
	 *
	 * @since   4.0.0
	 */
	public function featureArticle($title)
	{
		$I = $this;
		$I->amOnPage(ContentListPage::$url);
		$I->waitForElement(ContentListPage::$filterSearch, TIMEOUT);
		$I->searchForItem($title);
		$I->checkAllResults();
		$I->clickToolbarButton('feature');
		$I->seeNumberOfElements(ContentListPage::$seeFeatured, 1);
	}

	/**
	 * Helper function to set article access level
	 *
	 * @param   string  $title
	 * @param   string  $accessLevel
	 *
	 * @since   4.0.0
	 */
	public function setArticleAccessLevel($title, $accessLevel)
	{
		$I = $this;
		$I->amOnPage(ContentListPage::$url);
		$I->waitForElement(ContentListPage::$filterSearch, TIMEOUT);
		$I->searchForItem($title);
		$I->checkAllResults();
		$I->click($title);
		$I->waitForElement(['id' => "jform_access"], TIMEOUT);
		$I->selectOption(['id' => "jform_access"], $accessLevel);
		$I->click(ContentListPage::$dropDownToggle);
		$I->clickToolbarButton('Save & Close');
		$I->waitForElement(ContentListPage::$filterSearch, TIMEOUT);
		$I->see($accessLevel, ContentListPage::$seeAccessLevel);
	}

	/**
	 * Helper function to unpublish article
	 *
	 * @param   string  $title
	 *
	 * @since   4.0.0
	 */
	public function unPublishArticle($title)
	{
		$I = $this;
		$I->amOnPage(ContentListPage::$url);
		$I->waitForElement(ContentListPage::$filterSearch, TIMEOUT);
		$I->searchForItem($title);
		$I->checkAllResults();
		// Unpublish
		$I->clickToolbarButton('unpublish');
		$I->seeNumberOfElements(ContentListPage::$seeUnpublished, 1);
	}

	/**
	 * Helper function to publish article
	 *
	 * @param   string  $title
	 *
	 * @since   4.0.0
	 */
	public function publishArticle($title)
	{
		$I = $this;
		$I->amOnPage(ContentListPage::$url);
		$I->waitForElement(ContentListPage::$filterSearch, TIMEOUT);
		$I->searchForItem($title);
		$I->checkAllResults();
		$I->clickToolbarButton('publish');
		// Success message
		$I->see('1 article published.', Administrator\AdminPage::$systemMessageContainer);
	}

	/**
	 * Helper function to trash article
	 *
	 * @param   string  $title
	 *
	 * @since   4.0.0
	 */
	public function trashArticle($title)
	{
		$I = $this;
		$I->amOnPage(ContentListPage::$url);
		$I->waitForElement(ContentListPage::$filterSearch, TIMEOUT);
		$this->searchForItem($title);
		$I->checkAllResults();
		// Trash
		$I->clickToolbarButton('trash');
		$I->searchForItem($title);
	}
}
