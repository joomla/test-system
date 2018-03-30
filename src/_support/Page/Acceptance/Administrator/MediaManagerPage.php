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
 * Acceptance Page object class to media manager page objects.
 *
 * @package  Page\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class MediaManagerPage extends AdminPage
{
	/**
	 * Url to media manager listing page.
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $url = "administrator/index.php?option=com_media&path=local-0:/";

	/**
	 * Page title of the media manager listing page.
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $pageTitleText = 'Media';

	/**
	 * Page title of the media manager listing page.
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $container = ['class' => 'media-container'];

	/**
	 * Page title of the media manager listing page.
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $infoBar = ['class' => 'media-infobar'];

	/**
	 * The media browser items
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $items = ['class' => 'media-browser-item'];

	/**
	 * The media tree
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $mediaTree = ['class' => 'media-tree'];

	/**
	 * Button that toggles the info bar
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $toggleInfoBarButton = ['class' => 'media-toolbar-info'];

	/**
	 * The hidden file upload field
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $fileInputField = 'input[name=\'file\']';

	/**
	 * The hidden file upload field
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $toolbarDeleteButton = '//button[contains(@onclick, \'onClickDelete\')]';

	/**
	 * The item actions
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $itemActions = ['class' => 'media-browser-actions'];

	/**
	 * The rename action
	 *
	 * @var string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $renameAction = 'action-rename';

	/**
	 * The name field of modal forms
	 *
	 * @var array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $modalNameField = ['id' => 'name'];

	/**
	 * The confirm button of modals
	 *
	 * @var array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $modalConfirmButton = ['css' => '.modal button.btn-success'];

	/**
	 * Dynamic locator for media item files
	 *
	 * @var    string $name
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	public static function item($name)
	{
		return self::itemXpath($name);
	}

	/**
	 * Dynamic locator for media item action
	 *
	 * @var    string $itemName
	 * @var    string $actionName
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	public static function itemActionMenuToggler($itemName)
	{
		return self::itemXpath($itemName) . '//a[@class= \'action-toggle\']';
	}

	/**
	 * Dynamic locator for media item action
	 *
	 * @var    string $itemName
	 * @var    string $actionName
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	public static function itemAction($itemName, $actionName)
	{
		return self::itemXpath($itemName) . '//a[@class= \''. $actionName .'\']';
	}

	/**
	 * Get the xpath of a media item
	 *
	 * @var    string $name
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	protected static function itemXpath($name)
	{
		return '//div[contains(@class, \'media-browser-item-info\') and normalize-space(text()) = \'' . $name . '\']/parent::div';
	}
}
