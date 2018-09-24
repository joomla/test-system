<?php
/**
 * @package  Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc.All rights reserved.
 * @license     GNU General Public License version 2 or later;see LICENSE.txt
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
	 * Search Input
	 *
	 * @var   string
	 * @since 4.0.0
	 */
	public static $searchInput = '#filter_search';

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
	 * @var   string
	 * @since 4.0.0
	 */
	public static $menuDropDown = '//select[@id="jform_menutype"]';

	/**
	 * Selecting option from dropdown menu
	 *
	 * @var   string
	 * @since 4.0.0
	 */
	public static $selectOption = '//select[@id="jform_menutype"]/option[@value="mainmenu"]';

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
	 * @var    string
	 * @since  4.0.0
	 */
	public static $articlesLink = 'Articles';

	/**
	 * Archive Articles
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $archiveArticles = 'Archived Articles';

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
	 * @var    string
	 * @since  4.0.0
	 */
	public static $selectCategory = '//select[@id="jform_request_catid"]/option[2]';

	/**
	 * Drop Down Toggle Element.
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $dropDownToggle = "//button[contains(@class, 'dropdown-toggle')]";

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
	 * @var    string
	 * @since  4.0.0
	 */
	public static $selectMenuType = '//select[@id=\'jform_request_id\']';

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

