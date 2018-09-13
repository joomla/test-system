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
class moduleList
{
	// include url of current page
	public static $url = '/administrator/index.php?option=com_modules';
	/**
	 * Select Module Title
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $moduleTitle = ['id' => 'jform_title'];
	/**
	 * Select Filter Options
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $filterOptions = ['link' => 'Filtering Options'];
	/**
	 * Select Filter Options
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $selectCategory = ['id' => 'jform_params_catid'];
	/**
	 * Drop Down Toggle Element.
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $dropDownToggle = ['xpath' => "//button[contains(@class, 'dropdown-toggle')]"];
	/**
	 * Fill Category
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $fillCategory = ['xpath' => '//*[@id="jform_position_chzn"]/div/div/input'];
	/**
	 * Select
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $select = ['id' => 'jform_params_parent_select'];
	/**
	 * Select Options
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $selectOption1 = ['id' => 'cb0'];
	/**
	 * Select Option 2
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $selectOption2 = ['id' => 'cb1'];

}
