<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Step
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Step\Acceptance\Administrator;
use Page\Acceptance\Administrator\moduleList as ModuleList;
use Page\Acceptance\Administrator;
/**
 * Acceptance Step object class contains suits for MenuItem.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class moduleStep extends \AcceptanceTester
{
	/**
	 * Perform Toolbar operations
	 *
	 * @param   \AcceptanceTester $I          Acceptance Tester
	 * @param   string            $moduleName The Name of Module
	 *
	 * @return void
	 */
	public function applyToolbarButtonsOnModule(\AcceptanceTester $I, $moduleName)
	{
		$I->amOnPage(ModuleList::$url);
		$I->searchForItem($moduleName);
		$I->click(ModuleList::$selectOption1);
		$I->clickToolbarButton('Duplicate');
		// Unpublish
		$I->searchForItem($moduleName);
		$I->click(ModuleList::$selectOption2);
		$I->clickToolbarButton('unpublish');
		$I->see('1 module unpublished.', Administrator\AdminPage::$systemMessageContainer);
		// Check In
		$I->searchForItem($moduleName);
		$I->click(ModuleList::$selectOption1);
		$I->clickToolbarButton('check-in');
		$I->see('1 module checked in.', Administrator\AdminPage::$systemMessageContainer);
		//Trash
		$I->searchForItem($moduleName);
		$I->click(ModuleList::$selectOption2);
		$I->clickToolbarButton('trash');
		$I->see('1 module trashed.', Administrator\AdminPage::$systemMessageContainer);
		// Publish
		$I->searchForItem($moduleName);
		$I->click(ModuleList::$selectOption1);
		$I->clickToolbarButton('publish');
		$I->see('1 module published.', Administrator\AdminPage::$systemMessageContainer);
	}
}
