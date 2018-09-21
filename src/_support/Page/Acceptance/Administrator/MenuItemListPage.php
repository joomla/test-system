<?php
/**
 * @package  Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 20018 - 2019 Open Source Matters, Inc.All rights reserved.
 * @license     GNU General Public License version 2 or later;see LICENSE.txt
 */

namespace Page\Acceptance\Administrator;

/**
 * Acceptance Page object class to menuitem list page.
 *
 * @category  Users
 * @package   Page\Acceptance\Administrator
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @since     4.0.0
 */
class MenuItemListPage
{
	/**
	 * URL
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $url = "administrator/index.php?option=com_menus&view=items";

	/**
	 * Select Menu
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $selectMenu =  '#menutype';

	/**
	 * Select Menu Menu
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $selectMainMenu = '//select[@id="menutype"]/option[@value="mainmenu"]';

	/**
	 * Select  the checkbox status
	 *
	 * @var   string
	 * @since 4.0.0
	 */
	public static $checkItemOne =  '#cb0';

	/**
	 * Select Home Button
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $homeButton = '#toolbar-default';
}
