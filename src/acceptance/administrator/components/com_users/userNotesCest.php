<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace administrator\components\com_users;
use Page\Acceptance\Administrator\userNotesPage as UserNotes;
/**
 * Administrator UserNotes Tests
 *
 * @category  Menu_Article
 * @package   Administratorcomponentscom_Menu_Article
 * @author    Samarth sharma <samarthsharma351@gmail.com>
 * @copyright 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license   Joomla 2005-2018
 * @link      ArticleMenuCest
 * @since     __DEPLOYED_VERSION
 */
class userNotesCest
{
	public function __construct()
	{
		$this->username = "admin";
		$this->password = "admin";
		$this->name = "Super User";
		$this->category = "Uncategorised";
		$this->subject = "Test Subject";
		$this->notes = 'This is a test note for user '.$this->username;
	}
	/**
	 * Create a user notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   3.7.3
	 *
	 * @return  void
	 */
	public function createUserNotes(\AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotes::$url);
		// New
		$I->clickToolbarButton('New');
		$I->fillField(UserNotes::$subject,$this->subject);
		// Select User
		$I->click(UserNotes::$selectUserButton);
		$I->switchToIFrame('Select User');
		$I->wait(1);
		$I->searchForItem($this->username);
		$I->wait(1);
		$I->click(['link' => $this->name]);
		$I->switchToPreviousTab();
		$I->wait(1);
		// Select category
		$I->click(UserNotes::$selectCategory);
		$I->switchToIFrame('Select or Change Category');
		$I->wait(1);
		$I->searchForItem($this->category);
		$I->wait(1);
		$I->click(['link' => $this->category]);
		$I->switchToPreviousTab();
		$I->wait(1);
		// Fill editor
		$I->scrollTo(UserNotes::$editor);
		$I->scrollTo(UserNotes::$toggleEditor);
		$I->click(UserNotes::$toggleEditor);
		$I->fillField(UserNotes::$editor,$this->notes);
		// Save and close
		$I->click(UserNotes::$dropDownToggle);
		$I->clickToolbarButton('save & close');
	}
	/**
	 * Unpublish User Notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   3.7.3
	 *
	 * @return  void
	 */
	public function unpublishUserNote(\AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotes::$url);
		$I->searchForItem($this->subject);
		$I->click(UserNotes::$option1);
		$I->clickToolbarButton('unpublish');
	}
	/**
	 * Publish user notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   3.7.3
	 *
	 * @return  void
	 */
	public function publishUserNote(\AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotes::$url);
		$I->searchForItem($this->subject);
		$I->click(UserNotes::$option1);
		$I->clickToolbarButton('publish');
	}
	/**
	 * Check in user notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   3.7.3
	 *
	 * @return  void
	 */
	public function checkinUserNote(\AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotes::$url);
		$I->searchForItem($this->subject);
		$I->click(UserNotes::$option1);
		$I->clickToolbarButton('check-in');
	}
	/**
	 * Trash user notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   3.7.3
	 *
	 * @return  void
	 */
	public function trashUserNote(\AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotes::$url);
		$I->searchForItem($this->subject);
		$I->click(UserNotes::$option1);
		$I->clickToolbarButton('trash');
	}
}
