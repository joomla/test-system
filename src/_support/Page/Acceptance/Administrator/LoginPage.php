<?php namespace Page\Acceptance\Administrator;

/**
 * Acceptance Page object class for admin login.
 *
 * @package  Page\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class LoginPage
{
	/**
	 * Locator for the Login Page Url
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	public static $url = '/administrator/index.php';

	/**
	 * Locator for the login form
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $form = ['id' => 'form-login'];

	/**
	 * Locator for the username field
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $userNameField = ['id' => 'mod-login-username'];

	/**
	 * Locator for the Password field
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	public static $passwordField = ['id' => 'mod-login-password'];
}
