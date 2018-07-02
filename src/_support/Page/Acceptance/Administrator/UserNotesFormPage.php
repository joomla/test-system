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
 * @since     4.0.0
 */
class UserNotesFormPage
{
	/**
	 * Subject
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $subject = '#jform_subject';

	/**
	 * Select User Button
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $selectUserButton = ['xpath' => '//a[@title="Select User"]'];

	/**
	 * Select category
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $selectCategory = '#jform_catid_select';

	/**
	 * Editor
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $editor = '#jform_body';

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
	public static $toggleEditor = ['xpath' => '//a[@title="Toggle editor"]'];
}
