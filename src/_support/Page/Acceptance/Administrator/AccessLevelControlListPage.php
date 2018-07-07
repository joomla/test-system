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
 * Acceptance Page object class to Access Level Control List page.
 *
 * @category  Users
 * @package   Page\Acceptance\Administrator
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @since     4.0.0
 */

class AccessLevelControlListPage
{
	/**
	 * Url
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $url = 'administrator/index.php?option=com_users&view=users';
	/**
	 * Category Url
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $categoryUrl = 'administrator/index.php?option=com_categories&view=categories&extension=com_content';

}
