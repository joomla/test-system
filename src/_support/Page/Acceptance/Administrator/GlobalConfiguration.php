<?php
namespace Page\Acceptance\Administrator;

class GlobalConfiguration
{
	// include url of current page
	public static $url = '/administrator/index.php?option=com_config';
	/**
	 * Site Offline RadioButton
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $online = ['id' => 'jform_offline0'];
	/**
	 * Site Offline RadioButton
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $offline = ['id' => 'jform_offline1'];
	/**
	 * SEO No RadioButton
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $seoNo = ['id' => 'jform_sef0'];
	/**
	 * SEO Yes RadioButton
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $seoYes = ['id' => 'jform_sef1'];
	/**
	 * SEO Text
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $seoText = ['class' => 'switcher-labels'];
	/**
	 * Drop Down Toggle Element.
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $dropDownToggle = ['xpath' => "//button[contains(@class, 'dropdown-toggle')]"];


}
