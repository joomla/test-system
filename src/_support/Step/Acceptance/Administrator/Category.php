<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Step
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Step\Acceptance\Administrator;

use Behat\Gherkin\Node\TableNode;
use Page\Acceptance\Administrator\CategoryManagerPage;
use Page\Acceptance\Administrator\MenuManagerPage;
use Page\Acceptance\Site\FrontPage;

/**
 * Acceptance Step object class contains suits for Category Manager.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class Category extends Admin
{

	public function createCategory($title)
	{
		$this->amOnPage(CategoryManagerPage::$url);
		$this->waitForText("Articles: Categories", TIMEOUT, "//h1");
		$this->clickToolbarButton("New");
		$this->waitForElement(CategoryManagerPage::$title);
		$this->fillField(CategoryManagerPage::$title, $title);
		$this->click(CategoryManagerPage::$dropDownToggle);
		$this->clickToolbarButton("Save & Close");
		$this->categoryManagerPage->seeItemIsCreated($title);
	}
}
