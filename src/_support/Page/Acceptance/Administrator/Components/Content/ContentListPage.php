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
 * Class ContentListPage
 * @package Page\Acceptance\Administrator\Components\Content
 */
class ContentListPage extends AdminListPage
{
	/**
	 * Link to the article listing page.
	 *
	 * @var string
	 */
	public static $url = "/administrator/index.php?option=com_content&view=articles";

	/**
	 * Dynamic locator for article items
	 *
	 * @var string $title
	 *
	 * @return string
	 */
	public static function item(string $title): string
	{
		return self::itemXpath($title);
	}

	/**
	 * Dynamic locator for article item checkbox
	 *
	 * @var string $title
	 *
	 * @return string
	 */
	public static function itemCheckBox(string $title): string
	{
		return self::itemXpath($title) . '//input[@name=\'cid[]\']';
	}

	/**
	 * Dynamic locator for inline publish button
	 *
	 * @var string $title
	 *
	 * @return string
	 */
	public static function itemPublishButton(string $title): string
	{
		return self::itemXpath($title) . '//span[@class=\'icon-unpublish\']/parent::a';
	}

	/**
	 * Dynamic locator for inline unpublish button
	 *
	 * @var string $title
	 *
	 * @return string
	 */
	public static function itemUnPublishButton(string $title): string
	{
		return self::itemXpath($title) . '//span[@class=\'icon-publish\']/parent::a';
	}

	/**
	 * Dynamic locator for inline feature button
	 *
	 * @var string $title
	 *
	 * @return string
	 */
	public static function itemFeatureButton(string $title): string
	{
		return self::itemXpath($title) . '//span[@class=\'icon-unfeatured\']/parent::a';
	}

	/**
	 * Dynamic locator for inline feature button
	 *
	 * @var string $title
	 *
	 * @return string
	 */
	public static function itemUnFeatureButton(string $title): string
	{
		return self::itemXpath($title) . '//span[@class=\'icon-featured\']/parent::a';
	}

	/**
	 * Dynamic locator for inline feature button
	 *
	 * @var string $title
	 *
	 * @return string
	 */
	public static function itemUnArchiveButton(string $title): string
	{
		return self::itemXpath($title) . '//span[@class=\'icon-archive\']/parent::a';
	}

	/**
	 * Select an item from the list
	 *
	 * @param string $title
	 */
	public function selectItemFromList(string $title)
	{
		$I        = $this->tester;
		$checkBox = self::itemCheckBox($title);
		$I->seeElement($title);
		$I->checkOption($title);
	}

	/**
	 * Dynamic locator for media item action
	 *
	 * @param string $title
	 *
	 * @return string
	 */
	protected static function itemXpath(string $title): string
	{
		return '//a[@title = \'Edit ' . $title . '\']/ancestor::tr';
	}
}
