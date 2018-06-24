<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Page\Acceptance\Administrator;

/**
 * Acceptance Page object class to menu list page.
 *
 * @package  Page\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class MenuListPage extends AdminListPage
{
	/**
	 * Url to menu page.
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $url = "administrator/index.php?option=com_menus&view=menus";

	/**
	 * Page title of the menu page.
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $pageTitleText = 'Menus';

    	/**
     	 * Select the second menu
     	 * cb0 -> id of first option and cb1-> id of second option
     	 * @var string
     	 * @since  __DEPLOY_VERSION__
     	 * I will change the xpath later. This is for temporary basis
     	 */
	public static $menuSelect = ['id' => 'cb0'];

    	/**
     	 * Drop Down Toggle Element.
     	 *
     	 * @var    array
     	 * @since  __DEPLOY_VERSION__
 	 */
	public static $dropDownToggle = ['xpath' => "//button[contains(@class, 'dropdown-toggle')]"];
}
