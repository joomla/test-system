<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Page\Acceptance\Site;

/**
 * Acceptance Page object class to define Frontend page objects.
 *
 * @package  Page\Acceptance\Site
 *
 * @since    3.7.3
 */
class FrontPage extends \AcceptanceTester
{
	/**
	 * Link to the frontend
	 *
	 * @var    string
	 * @since  3.7.3
	 */
	public static $url = 'index.php';

	/**
	 * Locator for alert message in frontend.
	 *
	 * @var    string
	 * @since  3.7.3
	 */
	public static $alertMessage = '.alert-message';

	/**
	 * Locator for login greeting for the user.
	 *
	 * @var    string
	 * @since  3.7.3
	 */
	public static $loginGreeting = '.login-greeting';

	/**
	 * Locator for article settings
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $articleSettings = '//div[@class="btn-group float-right"]';

	/**
	 * Locator for editting article
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $editArticle = '//a[@title="Edit article"]';

	/**
	 * Locator for toggle editor
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $toggleEditor = '//a[@title="Toggle editor"]';

	/**
	 * Locator for editor
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $articleText = '#jform_articletext';

	/**
	 * Locator to save article
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $saveArticle = '//form[@id="adminForm"]/div/button[1]';
}
