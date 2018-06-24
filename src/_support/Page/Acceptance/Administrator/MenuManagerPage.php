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
 * Acceptance Page object class to menu objects.
 *
 * @package  Page\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class MenuManagerPage extends AdminPage
{
	/**
	 * Url to menu page.
	 *
	 * @var    string
	 * @since __DEPLOY_VERSION__
	 */
	public static $url = "administrator/index.php?option=com_menus&view=menus";

	/**
	 * Page title of the menu page.
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $pageTitleText = 'Menus';

    /**
     * Select the second menu
     *
     * @var    string
     * @since  __DEPLOY_VERSION__
	 * I will change the xpath later. This is for temporary basis
     */
	public static $menuSelect = ['xpath' => '/html/body/div[1]/div[2]/section/div/div/form/div/div[2]/div/table/tbody/tr[2]/td[2]/a'];

    /**
     * check on the checkbox
     *
     * @var    string
     * @since  __DEPLOY_VERSION__
     */
	public static $checkAll = ['class' => 'hasTooltip'];

    /**
     * Publish the menu
     *
     * @var    string
     * @since  __DEPLOY_VERSION__
     */
	public static $publish = ['id' => 'toolbar-publish'];

    /**
     * Unpublish the menu
     *
     * @var    string
     * @since  __DEPLOY_VERSION__
     */
    public static $unpublish = ['id' => 'toolbar-unpublish'];

}
