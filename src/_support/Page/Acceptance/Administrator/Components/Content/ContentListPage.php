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
	 * The table options container
	 *
	 * @var string
	 */
	public static $tableOptions = '//div[contains(@class, \'js-stools-container-filters\')]';

	/**
	 * The button to show/hide the table options
	 *
	 * @var string
	 */
	public static $toggleTableOptionsButton = '//button[contains(@class, \'js-stools-btn-filter\')]';

	/**
	 * The state filter select
	 *
	 * @var string
	 */
	public static $stateFilterSelect = '//select[@id = \'filter_published\']';

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
	 * Dynamic locator for inline checkin button
	 *
	 * @var string $title
	 *
	 * @return string
	 */
	public static function itemCheckinButton(string $title): string
	{
		return self::itemXpath($title) . '//span[@class=\'icon-checkedout\']/parent::a';
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
		$I->seeElement(self::item($title));
		$I->checkOption(self::itemCheckBox($title));
	}

	/**
	 * Open the table options
	 */
	public function openTableOptions()
	{
		$I = $this->tester;
		$I->seeElement(self::$toggleTableOptionsButton);
		$I->click(self::$toggleTableOptionsButton);
		$I->seeElement(self::$tableOptions);
	}

	/**
	 * Filter by state
	 *
	 * @param $state
	 */
	public function filterByState($state)
	{
		$I = $this->tester;
		$I->seeElement(self::$stateFilterSelect);
		$I->selectOption(self::$stateFilterSelect, $state);
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
