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
 * Acceptance Page object class to Access Level Control form page.
 *
 * @category  Users
 * @package   Page\Acceptance\Administrator
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @since     4.0.0
 */
class AccessLevelControlFormPage
{
	/**
	 * Url
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $url = 'administrator/index.php?option=com_users&view=user&layout=edit';

	/**
	 * Drop Down Toggle Element.
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $dropDownToggle = "//button[contains(@class, 'dropdown-toggle')]";

	/**
	 * Group public
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $groupPublic = '#lgroup_1';

	/**
	 * Group Guest
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $groupGuest = '#1group_9';

	/**
	 * Group Manager
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $groupManager = '#1group_6';

	/**
	 * Group Admin
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $groupAdmin = '#1group_7';

	/**
	 * Group Registered
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $groupRegistered = '#1group_2';

	/**
	 * Group Author
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $groupAuthor = '#1group_3';

	/**
	 * Manager Create
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $managerCreateSelect = '#jform_rules_core.create_6';

	/**
	 * Manager Create
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $managerDeleteSelect = '#jform_rules_core.delete_6';

	/**
	 * Manager Edit
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $managerEditSelect = '#jform_rules_core.edit_6';

	/**
	 * Manager Edit Own
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $managerEditOwnSelect = '#jform_rules_core.edit.own_6';

	/**
	 * Manager Edit State
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $managerEditStateSelect = '#jform_rules_core.edit.state_6';

	/**
	 * Author Edit Own
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $authorEditSelect = '#jform_rules_core.edit_3';

	/**
	 * Author Create
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $authorEditStateSelect = '#jform_rules_core.edit.state_3';

	/**
	 * Author Delete
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $authorDeleteSelect = '#jform_rules_core.delete_3';
}
