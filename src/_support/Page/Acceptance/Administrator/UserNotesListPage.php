<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Page\Acceptance\Administrator;

/**
 * Acceptance Page object class to user list page.
 *
 * @package  Page\Acceptance\Administrator
 *
 * @since    4.0.0
 */
class UserNotesListPage
{
	/**
	 * Include url of current page
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $url = '/administrator/index.php?option=com_users&view=notes';

	/**
	 * Option one in list
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $option1 = ['id' => 'cb0'];
}
