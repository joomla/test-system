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
 * Acceptance Page object class to user list page.
 *
 * @package  Page\Acceptance\Administrator
 *
 * @since    3.7.3
 */
class userNotesListPage
{
	// Include url of current page
	public static $url = '/administrator/index.php?option=com_users&view=notes';

	/**
	 * Option one in list
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $option1 = ['id' => 'cb0'];
}
