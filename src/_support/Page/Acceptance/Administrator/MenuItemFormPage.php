<?php
/**
 * @package  Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc.All rights reserved.
 * @license     GNU General Public License version 2 or later;see LICENSE.txt
 *  7.0.30
 */
namespace Page\Acceptance\Administrator;

/**
 * Acceptance Page object class to menuitem form page.
 *
 * @category  Users
 * @package   Page\Acceptance\Administrator
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @since     4.0.0
 */
class MenuItemFormPage
{
	/**
	 * Menu Item Title
	 *
	 * @var   string
	 * @since 4.0.0
	 */
	public static $menuItemTitle = '#jform_title';

	/**
	 * Menu Item Alias
	 *
	 * @var   string
	 * @since 4.0.0
	 */
	public static $menuItemAlias = '#jform_alias';

	/**
	 * Menu Item Save
	 *
	 * @var   string
	 * @since 4.0.0
	 */
	public static  $saveButton = '#toolbar-apply';

	/**
	 * Page title of the user manager listing page.
	 *
	 * @var   string
	 * @since 4.0.0
	 */
	public static $pageTitleText = "Menus";

	/**
	 * A drop down menu
	 *
	 * @var   array
	 * @since 4.0.0
	 */
	public static $menuDropDown = ['xpath' => '//select[@id="jform_menutype"]'];

	/**
	 * Selecting option from dropdown menu
	 *
	 * @var   string
	 * @since 4.0.0
	 */
	public static $selectOption = ['xpath' => '//select[@id="jform_menutype"]/option[@value="mainmenu"]'];

	/**
	 * Select Menu Type Modal
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $menuTypeModal =  '#menuTypeModal';

	/**
	 * Select Article Link
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $articlesLink = ['link' => 'Articles'];

	/**
	 * Archive Articles
	 *
	 * @var    array
	 * @since  4.0.0
	 */
		public static $archiveArticles = ['link' => 'Archived Articles'];

	/**
	 * Success Message
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $successMessage = 'Menu item saved';

	/**
	 * Select category
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $selectCategory = ['xpath' => '//select[@id="jform_request_catid"]/option[2]'];

	/**
	 * Drop Down Toggle Element.
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $dropDownToggle = ['xpath' => "//button[contains(@class, 'dropdown-toggle')]"];

	/**
	 * Selecting category or article
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $select =  '#jform_request_id_select';

	/**
	 * Select Menu Type
	 *
	 * @var    array
	 * @since  4.0.0
	 */
	public static $selectMenuType = ['xpath' => '//select[@id=\'jform_request_id\']'];

	/**
	 * Select Archived Article
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $selectArchivedArticle =  '#jform_request_catid';

	/**
	 * Select wrapper url
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $wrapperUrl =  '#jform_params_url';

}

