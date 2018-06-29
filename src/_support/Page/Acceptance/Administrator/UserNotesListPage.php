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
 * @category  Users
 * @package   Page\Acceptance\Administrator
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @since     4.0.0
 */
class UserNotesListPage
{
    // Include url of current page
    public static $url = '/administrator/index.php?option=com_users&view=notes';

    /**
     * Option one in list
     *
     * @var    array
     * @since  4.0.0
     */
    public static $optionOne = ['id' => 'cb0'];

    /**
     * Unpublish status
     *
     * @var    array
     * @since  4.0.0
     */
}
