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
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @link      User Notes Form Page
 * @since     4.0.0
 */
class UserNotesFormPage
{
	/**
	 * Subject
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $subject = ['id' => 'jform_subject'];

	/**
	 * Select User Button
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $selectUserButton = ['xpath' => '//*[@title="Select User"]'];

	/**
	 * Select category
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $selectCategory = ['id' => 'jform_catid_select'];

	/**
	 * Editor
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $editor = ['id' => 'jform_body'];

	/**
	 * Drop Down Toggle Element.
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $dropDownToggle = ['xpath' => "//button[contains(@class, 'dropdown-toggle')]"];

	/**
	 * Toggle editor
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $toggleEditor = ['xpath' => '//*[@title="Toggle editor"]'];
}
