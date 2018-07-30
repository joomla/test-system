<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Step
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Step\Acceptance\Site;

use Page\Acceptance\Site\FrontPage;
/**
 * Acceptance Step object class contains suits for Front End.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    4.0.0
 */
class FrontEnd extends \AcceptanceTester
{
	/**
	 * Check whether Item is not Visible on front end
	 *
	 * @param   string  $itemName  Menu Item Name
	 *
	 * @return void
	 */
	public function notVisible($itemName)
	{
        	$I = $this;
		$I->comment('Make sure the menu item is not on site After unpublishing it');
		$I->amOnPage(FrontPage::$url);
        	// Assertion
		$I->dontSee($itemName);
	}

	/**
	 * Check whether Item is Visible on front end
	 *
	 * @param   string  $itemName Menu Item Name
	 *
	 * @return void
	 */
	public function isVisible($itemName)
	{
        	$I = $this;
		$I->comment('Check the menu item on site After publishing it');
		$I->amOnPage(FrontPage::$url);
        	// Assertion
		$I->see($itemName);
	}

	/**
	 * Check whether article is not Visible on front end
	 *
	 * @param   string  $menuItemName  Menu Item Name
	 * @param   string  $articleName   Article Name
	 *
	 * @return void
	 */
	public function articleIsVisible($menuItemName, $articleName)
	{
	    	$I = $this;
		$I->comment('Check the menu item on site After publishing it');
		$I->amOnPage(FrontPage::$url);
		$I->see($menuItemName);
		$I->click($menuItemName);
		$I->see($articleName);
	}

	/**
	 * Check whether article is not Visible on front end
	 *
	 * @param   string  $menuItemName  Menu Item Name
	 * @param   string  $articleName   Article Name
	 *
	 * @return void
	 */
	public function articleIsNotVisible($menuItemName, $articleName)
	{
	    	$I = $this;
		$I->comment('Check the menu item on site After publishing it');
		$I->amOnPage(FrontPage::$url);
		$I->see($menuItemName);
		$I->click($menuItemName);
		$I->dontSee($articleName);
	}
}
