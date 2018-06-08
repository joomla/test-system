<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace administrator\components\com_menu_article;
use Step\Acceptance\Administrator\Content as ContentStep;
use Step\Acceptance\Administrator\MenuItem as MenuItemStep;
use Page\Acceptance\Administrator\ContentListPage;
use Page\Acceptance\Administrator;
use Faker\Factory as fakerLib;

/**
 * Class ArticleMenuCest
 *
 * @category  Menu_Article
 * @package   Administratorcomponentscom_Menu_Article
 * @author    Samarth sharma <samarthsharma351@gmail.com>
 * @copyright 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license   Joomla 2005-2018
 * @link      ArticleMenuCest
 * @since     __DEPLOYED_VERSION
 */
class ArticleMenuCest
{
	public function __construct()
	{
		$faker = fakerLib::create();
		$this->articleTitle = $faker->name;
		$this->articleContent = $faker->text;
		$this->menuItemName = $faker->name;
		$this->menuItemAlias = $faker->userName;
	}
	/**
	 * Article is created
	 *
	 * @param   \AcceptanceTester   $I        Acceptance Tester
	 * @param   string              $scenario Scenario
	 *
	 * @return void
	 */
	public function article(\AcceptanceTester $I, $scenario)
	{
		$I = new ContentStep($scenario);
		$I->doAdministratorLogin();
		$I->createArticle($this->articleTitle, $this->articleContent, 'SamSham');
	}
	/**
	 * Create Menu For Article
	 *
	 * @param   \AcceptanceTester $I Acceptance Tester
	 *
	 * @return void
	 */
	public function createMenuForArticle(\AcceptanceTester $I)
	{
		MenuItemStep::menuItem($I, $this->menuItemName, $this->menuItemAlias, $this->articleTitle, 'Articles', 'Single Article');
	}
	/**
	 * Create Menu For Article
	 *
	 * @param   \AcceptanceTester $I        Acceptance Tester
	 * @param   string            $scenario Scenario
	 *
	 * @return void
	 */
	public function performToolbarFunctions(\AcceptanceTester $I, $scenario)
	{
		$I = new ContentStep($scenario);
		$I->doAdministratorLogin();

		$I->amOnPage(ContentListPage::$url);
		$I->checkForPhpNoticesOrWarnings();

		// Unpublish
		$I->unPublishArticle($this->articleTitle);
		FrontEnd::articleIsNotVisible($I, $this->menuItemName, $this->articleTitle);
        	$I->see('The requested page can\'t be found.');

		// Publish
		$I->publishArticle($this->articleTitle);
		FrontEnd::articleIsVisible($I, $this->menuItemName, $this->articleTitle);
		
		// Trash
		$I->trashArticle($this->articleTitle);
		FrontEnd::articleIsNotVisible($I, $this->menuItemName, $this->articleTitle);
	        $I->see('The requested page can\'t be found.');
		
	}

}
