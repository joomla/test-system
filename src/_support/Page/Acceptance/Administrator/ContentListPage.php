<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Page\Acceptance\Administrator;

/**
 * Acceptance Page object class for content list page.
 *
 * @package  Page\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class ContentListPage extends AdminListPage
{
	/**
	 * Link to the article listing page.
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $url = "/administrator/index.php?option=com_content&view=articles";

	/**
	 * Dynamic locator for article items
	 *
	 * @var    string $title
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	public static function item($title)
	{
		return self::itemXpath($title);
	}

	/**
	 * Dynamic locator for article item checkbox
	 *
	 * @var    string $title
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	public static function itemCheckBox($title)
	{
		return self::itemXpath($title) . '//input[@name=\'cid[]\']';
	}

	/**
	 * Dynamic locator for inline publish button
	 *
	 * @var    string $title
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	public static function itemPublishButton($title)
	{
		return self::itemXpath($title) . '//a[contains(@class, \'data-state-0\')]';
	}

	/**
	 * Dynamic locator for inline unpublish button
	 *
	 * @var    string $title
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	public static function itemUnPublishButton($title)
	{
		return self::itemXpath($title) . '//a[contains(@class, \'data-state-1\')]';
	}

	/**
	 * Dynamic locator for media item action
	 *
	 * @param string $title
	 *
	 * @return string
	 */
	protected static function itemXpath($title)
	{
		return '//a[@title = \'Edit ' . $title . '\']/ancestor::tr';
	}
}
