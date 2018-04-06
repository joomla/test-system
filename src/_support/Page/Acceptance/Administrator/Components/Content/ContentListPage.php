<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Page\Acceptance\Administrator\Components\Content;

use Page\Acceptance\Administrator\AdminListPage;

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
		return self::itemXpath($title) . '//span[@class=\'icon-unpublish\']/parent::a';
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
		return self::itemXpath($title) . '//span[@class=\'icon-publish\']/parent::a';
	}

	/**
	 * Dynamic locator for inline feature button
	 *
	 * @var    string $title
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	public static function itemFeatureButton($title)
	{
		return self::itemXpath($title) . '//span[@class=\'icon-unfeatured\']/parent::a';
	}

	/**
	 * Dynamic locator for inline feature button
	 *
	 * @var    string $title
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	public static function itemUnFeatureButton($title)
	{
		return self::itemXpath($title) . '//span[@class=\'icon-featured\']/parent::a';
	}

	/**
	 * Dynamic locator for inline feature button
	 *
	 * @var    string $title
	 *
	 * @since  __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	public static function itemUnArchiveButton($title)
	{
		return self::itemXpath($title) . '//span[@class=\'icon-archive\']/parent::a';
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

	/**
	 * Select an item from the list
	 *
	 * @param $itemTitle
	 */
	public function selectItemFromList($itemTitle)
	{
		$I        = $this->tester;
		$checkBox = self::itemCheckBox($itemTitle);
		$I->seeElement($checkBox);
		$I->checkOption($checkBox);
	}
}
