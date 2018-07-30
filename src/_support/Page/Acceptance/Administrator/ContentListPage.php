<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Page\Acceptance\Administrator;

/**
 * Acceptance Page object class for article list page.
 *
 * @package  Page\Acceptance\Administrator
 *
 * @since    4.0.0
 */
class ContentListPage extends AdminListPage
{
	/**
	 * Link to the article listing page.
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $url = "/administrator/index.php?option=com_content&view=articles";

	/**
	 * Drop Down Toggle Element.
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $dropDownToggle = "//button[contains(@class, 'dropdown-toggle')]";

	/**
	 * Page object for content body editor field.
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $content = '#jform_articletext';

	/**
	 * Page object for the toggle button.
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $toggleEditor = "Toggle editor";

	/**
	 * Locator for article's unpublish icon
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $seeUnpublished = "//table[@id='articleList']//*//span[@class='icon-unpublish']";

	/**
	 * Locator for selecting Article's category
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public static $selectCategory = "//div[@id='jform_catid_chzn']";

	/**
	 * Locator for selecting Article's category
	 *
	 * @var    string
	 * @since  4.0.0
	 * The input doesn't have any id or class so I had to use tree structure for xpath
	 */
	public static $fillCategory = '//div[@id="jform_catid_chzn"]/div/div/input';

	/**
	 * Method to create new article
	 *
	 * @param   string  $title    The article title
	 * @param   string  $content  The article content
	 *
	 * @When    I create new content with field title as :title and content as a :content
	 *
	 * @since   4.0.0
	 *
	 * @return  void
	 */
	public function fillContentCreateForm(\AcceptanceTester $I,$title, $content)
	{
		$I->fillField(self::$title, $title);
		$I->scrollTo(['css' => 'div.toggle-editor']);
		$I->click(self::$toggleEditor);
		$I->fillField(self::$content, $content);
	}
}
