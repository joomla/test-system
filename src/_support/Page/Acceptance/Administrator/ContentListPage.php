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
 * Acceptance Page object class for article list page.
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
	 * Drop Down Toggle Element.
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $dropDownToggle = ['xpath' => "//button[contains(@class, 'dropdown-toggle')]"];

	/**
	 * Page object for content body editor field.
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $content = ['id' => 'jform_articletext'];

	/**
	 * Page object for the toggle button.
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $toggleEditor = "Toggle editor";

	/**
	 * Locator for article's name field
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $seeName = ['xpath' => "//table[@id='articleList']//tr[1]//td[4]"];

	/**
	 * Locator for article's featured icon
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $seeFeatured = ['xpath' => "//table[@id='articleList']//*//span[@class='icon-featured']"];

	/**
	 * Locator for article's name field
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $seeAccessLevel = ['xpath' => "//table[@id='articleList']//tr[1]//td[5]"];

	/**
	 * Locator for article's unpublish icon
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $seeUnpublished = ['xpath' => "//table[@id='articleList']//*//span[@class='icon-unpublish']"];

	/**
	 * Locator for selecting Article's category
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $selectCategory = ['xpath' => "//div[@id='jform_catid_chzn']"];

	/**
	 * Locator for selecting Article's category
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 * The input doesn't have any id or class so I had to use tree structure for xpath
	 */
	public static $fillCategory = ['xpath' => '//*[@id="jform_catid_chzn"]/div/div/input'];

	/**
	 * Method to create new article
	 *
	 * @param   \AcceptanceTester $I        The Acceptance Tester
	 * @param   string            $title    The article title
	 * @param   string            $content  The article content
	 *
	 * @When    I create new content with field title as :title and content as a :content
	 *
	 * @since   __DEPLOY_VERSION__
	 * @return  void
	 */
	public function fillContentCreateForm(\AcceptanceTester $I, $title, $content)
	{
		$I->fillField(self::$title, $title);
		$I->scrollTo(['css' => 'div.toggle-editor']);
		$I->click(self::$toggleEditor);
		$I->fillField(self::$content, $content);
	}
}
