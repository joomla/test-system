<?php
namespace Page\Acceptance\Administrator;

class MenuItemList
{
	/**
	 * URL for MenuItem List
	 *
	 * @var   string
	 * @since 3.7.3
	 */
	public static $url = "administrator/index.php?option=com_menus&view=items";

	/**
	 * Select Menu
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $selectMenu = ['id' => 'menutype'];

	/**
	 * Select Menu Menu
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $selectMainMenu = ['xpath' => '//select[@id="menutype"]/option[@value="mainmenu"]'];

	/**
	 * Select  the checkbox status
	 *
	 * @var   string
	 * @since __DEPLOY_VERSION__
	 */
	public static $check = ['id' => 'cb0'];

	/**
	 * Select Home Button
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $homeButton = ['id' => 'toolbar-default'];

	/**
	 * Select Check in
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $checkInButton = ['id' => 'toolbar-checkin'];


}
