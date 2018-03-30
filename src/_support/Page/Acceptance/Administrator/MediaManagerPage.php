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
	 * Button that toggles the info bar
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $toggleInfoBarButton = ['class' => 'media-toolbar-info'];

	/**
	 * The item preview of a media item
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $itemPreview ='//div[@class=\'media-browser-item-preview\']';

	/**
	 * Powered by Image
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $bannersFolder = '//div[contains(@class, \'media-browser-item-info\') and normalize-space(text()) = \'banners\']/parent::div';

	/**
	 * Powered by Image
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $poweredByImage = '//div[contains(@class, \'media-browser-item-info\') and normalize-space(text()) = \'powered_by.png\']/parent::div';

	/**
	 * The hidden file upload field
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $fileInputField = 'input[name=\'file\']';
}
