<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Page\Acceptance\Administrator\UserListPage;

/**
 * Administrator User Tests
 *
 * @since  3.7.3
 */
class UserListCest
{
	public function __construct()
	{
		$this->username = "TestUser101";
		$this->password = "testUser101";
		$this->name = "User Testing 101 Joomla";
		$this->email = "TestbotJoomla101@joomla.org";
	}
	/**
	 * Create a user
	 *
	 * @param   \Step\Acceptance\Administrator\Admin  $I The AcceptanceTester Object
	 *
	 * @since   3.7.3
	 *
	 * @return  void
	 */
	public function createUser(\Step\Acceptance\Administrator\Admin $I)
	{
		$I->comment('I am going to create a user');
		$I->doAdministratorLogin();
		$this->toggleSendMail($I);
		$I->amOnPage(UserListPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		$I->waitForText(UserListPage::$pageTitleText);

		// New
		$I->click(UserListPage::$newButton);
		$I->waitForElement(UserListPage::$accountDetailsTab);
		$I->checkForPhpNoticesOrWarnings();
		$this->fillUserForm($I, $this->name, $this->username, $this->password, $this->email);

		// Make him SuperUser
		$I->click(['link' => 'Assigned User Groups']);
		$I->click(UserListPage::$superUserCheckBox);

		// Save
		$I->clickToolbarButton("Save");
		$I->waitForText(UserListPage::$pageTitleText);
		$I->seeSystemMessage(UserListPage::$successMessage);

		// Verfication 1
		$I->amOnPage(UserListPage::$url);
		$I->searchForItem($this->username);

		//Verification 2
		$I->checkForPhpNoticesOrWarnings();
		$I->doAdministratorLogout();
		$I->doAdministratorLogin($this->username,$this->password);
		$I->amOnPage(UserListPage::$url);
		$I->searchForItem($this->username);

		// Verification 3 : Frontend Verification
		$I->doFrontEndLogin($this->username,$this->password);
		$I->scrollTo(UserListPage::$userGreeting);
		$I->see('Hi '.$this->name,UserListPage::$userGreeting);
	}
	/**
	 * Edit a user
	 *
	 * @param   \Step\Acceptance\Administrator\Admin $I  The AcceptanceTester Object
	 *
	 * @since   3.7.3
	 *
	 * @depends createUser
	 *
	 * @return  void
	 */
	public function editUser(\Step\Acceptance\Administrator\Admin $I)
	{
		$I->comment('I am going to edit a user');
		$I->doAdministratorLogin();

		$I->amOnPage(UserListPage::$url);
		$I->waitForText(UserListPage::$pageTitleText);

		$I->click(UserListPage::$userCheckbox);
		$I->click($this->name);

		$I->waitForElement(UserListPage::$accountDetailsTab);
		$I->checkForPhpNoticesOrWarnings();

		$this->fillUserForm($I, $this->name, $this->username, $this->password, $this->email);

		$I->clickToolbarButton("save");
		$I->waitForText(UserListPage::$pageTitleText);

		$I->seeSystemMessage(UserListPage::$successMessage);
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
		$I->click(UserListPage::$accountDetailsTab);
		$I->waitForElementVisible(UserListPage::$nameField, 30);
		$I->fillField(UserListPage::$nameField, $name);
		$I->fillField(UserListPage::$usernameField, $username);
		$I->fillField(UserListPage::$passwordField, $password);
		$I->fillField(UserListPage::$password2Field, $password);
		$I->fillField(UserListPage::$emailField, $email);
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
		$I->clickToolbarButton("Save");
		$I->comment('I wait for global configuration being saved');
		$I->waitForText('Global Configuration', TIMEOUT, ['css' => '.page-title']);
		$I->see('Configuration saved.', ['id' => 'system-message-container']);

	}
}
