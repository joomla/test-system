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
 * Acceptance Page object class to user form page.
 *
 * @package  Page\Acceptance\Administrator
 *
 * @since    3.7.3
 */
class userNotesFormPage
{
	// Include url of current page
	public static $url = '/administrator/index.php?option=com_users&view=notes';

	/**
	 * Subject
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $subject = ['id' => 'jform_subject'];

	/**
	 * Select User Button
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $selectUserButton = ['xpath' => '//*[@title="Select User"]'];

	/**
	 * Select category
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $selectCategory = ['id' => 'jform_catid_select'];

	/**
	 * Editor
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $editor = ['id' => 'jform_body'];

	/**
	 * Drop Down Toggle Element.
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $dropDownToggle = ['xpath' => "//button[contains(@class, 'dropdown-toggle')]"];

	/**
	 * Toggle editor
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $toggleEditor = ['xpath' => '//*[@title="Toggle editor"]'];
}
