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
 * @category  Users
 * @package   Page\Acceptance\Administrator
 * @author    Samarth sharma <samarthsharma351@gmail.com>
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   Joomla 2005-2018
 * @link      User Notes Form Page
 * @since     4.0.0
 */
class UserNotesFormPage
{
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
