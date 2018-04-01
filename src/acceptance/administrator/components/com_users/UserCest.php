<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Page\Acceptance\Administrator;

/**
 * Administrator User Tests
 *
 * @since  3.7.3
 */
class UserCest
{

	public function __construct()
	{
		$this->username = "testUser";
		$this->password = "test";
		$this->name = "Test Bot";
		$this->email = "Testbot@example.com";
	}

	/**
	 * Create a user
	 *
	 * @param   AcceptanceTester  $I  The AcceptanceTester Object
	 *
	 * @since   3.7.3
	 *
	 * @return  void
	 */
	public function createUser(\AcceptanceTester $I)
	{
		$I->comment('I am going to create a user');
		$I->doAdministratorLogin();
		$this->toggleSendMail($I);

		$I->amOnPage(Administrator\UserManagerPage::$url);
		$I->checkForPhpNoticesOrWarnings();

		$I->waitForText(Administrator\UserManagerPage::$pageTitleText);

		$I->click(Administrator\UserManagerPage::$newButton);

		$I->waitForElement(Administrator\UserManagerPage::$accountDetailsTab);
		$I->checkForPhpNoticesOrWarnings();

		$this->fillUserForm($I, $this->name, $this->username, $this->password, $this->email);

		$I->clickToolbarButton("Save");
		$I->waitForText(Administrator\UserManagerPage::$pageTitleText);
		$I->see(Administrator\UserManagerPage::$successMessage, Administrator\AdminPage::$systemMessageContainer);

		$I->checkForPhpNoticesOrWarnings();
	}

	/**
	 * Edit a user
	 *
	 * @param   AcceptanceTester  $I  The AcceptanceTester Object
	 *
	 * @since   3.7.3
	 *
	 * @depends createUser
	 *
	 * @return  void
	 */
	public function editUser(\AcceptanceTester $I)
	{
		$I->comment('I am going to edit a user');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\UserManagerPage::$url);
		$I->waitForText(Administrator\UserManagerPage::$pageTitleText);

		$I->click(Administrator\UserManagerPage::$userCheckbox);
		$I->click($this->name);

		$I->waitForElement(Administrator\UserManagerPage::$accountDetailsTab);
		$I->checkForPhpNoticesOrWarnings();

		$this->fillUserForm($I, $this->name, $this->username, $this->password, $this->email);

		$I->clickToolbarButton("Save");
		$I->waitForText(Administrator\UserManagerPage::$pageTitleText);

		$I->see(Administrator\UserManagerPage::$successMessage, Administrator\AdminPage::$systemMessageContainer);
		$I->checkForPhpNoticesOrWarnings();
	}

	/**
	 * Method is a page object to fill user form with given information and prepare to save user.
	 *
	 * @param   AcceptanceTester  $I         The AcceptanceTester Object
	 * @param   string            $name      User's name
	 * @param   string            $username  User's username
	 * @param   string            $password  User's password
	 * @param   string            $email     User's email
	 *
	 * @since   3.7.3
	 *
	 * @return  void  The user's form will be filled with given detail
	 */
	protected function fillUserForm($I, $name, $username, $password, $email)
	{
		$I->click(Administrator\UserManagerPage::$accountDetailsTab);
		$I->waitForElementVisible(Administrator\UserManagerPage::$nameField, 30);
		$I->fillField(Administrator\UserManagerPage::$nameField, $name);
		$I->fillField(Administrator\UserManagerPage::$usernameField, $username);
		$I->fillField(Administrator\UserManagerPage::$passwordField, $password);
		$I->fillField(Administrator\UserManagerPage::$password2Field, $password);
		$I->fillField(Administrator\UserManagerPage::$emailField, $email);
	}
	
	/**
	 * Method to set Send Email to "NO"
	 *
	 * @param   AcceptanceTester  $I         The AcceptanceTester Object
	 *
	 * @since   4.0
	 *
	 * @return  void  The user's form will be filled with given detail
	 */
	protected function toggleSendMail($I)
	{
		$I->amOnPage('/administrator/index.php?option=com_config');
		$I->waitForText('Global Configuration', TIMEOUT, ['css' => '.page-title']);
		$I->comment('I open the Server Tab');
		$I->click(['link' => 'Server']);
		$I->comment('I wait for error reporting dropdown');
		$I->click(['xpath' => "//input[@type='radio' and @value=0 and @name='jform[mailonline]']"]);
		$I->comment('I click on save');
		$I->click(['id' => 'toolbar-apply']);
		$I->comment('I wait for global configuration being saved');
		$I->waitForText('Global Configuration', TIMEOUT, ['css' => '.page-title']);
		$I->see('Configuration saved.', ['id' => 'system-message-container']);

	}
}
