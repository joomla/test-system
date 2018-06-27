<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace administrator\components\com_users;
use Page\Acceptance\Administrator\UserNotesListPage as UserNotesList;
use Page\Acceptance\Administrator\UserNotesFormPage as UserNotesForm;
/**
 * Administrator UserNotes Tests
 *
 * @category  Users
 * @package   Administratorcomponentscom_Users
 * @author    Samarth sharma <samarthsharma351@gmail.com>
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   Joomla 2005-2018
 * @link      User Notes
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
		$this->editorText = 'This is a test note for user '. $this->username;
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
        $I->wantToTest('creating user notes ');
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotesList::$url);
		// New
		$I->clickToolbarButton('New');
		$I->fillField(UserNotesForm::$subject,$this->subject);
		// Select User
		$I->click(UserNotesForm::$selectUserButton);
		$I->switchToIFrame('Select User');
		$I->searchForItem($this->username);
		$I->click(['link' => $this->name]);
		$I->switchToPreviousTab();
		// Select category
		$I->click(UserNotesForm::$selectCategory);
		$I->switchToIFrame('Select or Change Category');
		$I->searchForItem($this->category);
		$I->click(['link' => $this->category]);
		$I->switchToPreviousTab();
		// Fill editor
		$I->scrollTo(UserNotesForm::$editor);
		$I->scrollTo(UserNotesForm::$toggleEditor);
		$I->click(UserNotesForm::$toggleEditor);
		$I->fillField(UserNotesForm::$editor, $this->editorText);
		// Save and close
		$I->click(UserNotesForm::$dropDownToggle);
		$I->clickToolbarButton('save & close');
	}

	/**
	 * Unpublish User Notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   __DEPLOYED_VERSION
	 *
	 * @return  void
	 */
	public function unpublishUserNote(\AcceptanceTester $I)
	{
        $I->wantToTest('that user notes are unpublished.');
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotesList::$url);
		$I->searchForItem($this->subject);
		$I->click(UserNotesList::$option1);
		$I->clickToolbarButton('unpublish');
	}

	/**
	 * Publish user notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   __DEPLOYED_VERSION
	 *
	 * @return  void
	 */
	public function publishUserNote(\AcceptanceTester $I)
	{
        $I->wantToTest('that user note is published');
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotesList::$url);
		$I->searchForItem($this->subject);
		$I->click(UserNotesList::$option1);
		$I->clickToolbarButton('publish');
	}

	/**
	 * Check in user notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   __DEPLOYED_VERSION
	 *
	 * @return  void
	 */
	public function checkinUserNote(\AcceptanceTester $I)
	{
        $I->wantToTest('that user note is checked in');
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotesList::$url);
		$I->searchForItem($this->subject);
		$I->click(UserNotesList::$option1);
		$I->clickToolbarButton('check-in');
	}

	/**
	 * Trash user notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   __DEPLOYED_VERSION
	 *
	 * @return  void
	 */
	public function trashUserNote(\AcceptanceTester $I)
	{
        $I->wantToTest('that user note is trashed');
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotesList::$url);
		$I->searchForItem($this->subject);
		$I->click(UserNotesList::$option1);
		$I->clickToolbarButton('trash');
	}
}
