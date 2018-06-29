<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Page\Acceptance\Administrator\UserNotesListPage;
use Page\Acceptance\Administrator\UserNotesFormPage;

/**
 * Administrator UserNotes Tests
 *
 * @category  Users
 * @package   Administratorcomponentscom_Users
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @link      User Notes
 * @since     4.0.0
 */
class UserNotesCest
{
	public function __construct()
	{
		$this->username = "admin";
		$this->password = "admin";
		$this->name = "Super User";
		$this->category = "Uncategorised";
		$this->subject = "Test Subject 999";
		$this->editorText = 'This is a test note for user '. $this->username;
	}

	/**
	 * Create a user notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   4.0.0
	 *
	 * @return  void
	 */
	public function createUserNotes(\AcceptanceTester $I)
	{
		$I->wantToTest('creating user notes ');
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotesListPage::$url);
		// New
		$I->clickToolbarButton('New');
		$I->fillField(UserNotesFormPage::$subject,$this->subject);
		// Select User
		$I->click(UserNotesFormPage::$selectUserButton);
		$I->switchToIFrame('Select User');
		$I->searchForItem($this->username);
		$I->click(['link' => $this->name]);
		$I->switchToPreviousTab();
		// Select category
		$I->click(UserNotesFormPage::$selectCategory);
		$I->switchToIFrame('Select or Change Category');
		$I->searchForItem($this->category);
		$I->click(['link' => $this->category]);
		$I->switchToPreviousTab();
		// Fill editor
		$I->scrollTo(UserNotesFormPage::$editor);
		$I->scrollTo(UserNotesFormPage::$toggleEditor);
		$I->click(UserNotesFormPage::$toggleEditor);
		$I->fillField(UserNotesFormPage::$editor,$this->editorText);
		// Save and close
		$I->click(UserNotesFormPage::$dropDownToggle);
		$I->clickToolbarButton('save & close');
		$I->searchForItem($this->subject);
		$I->see($this->subject);
	}

	/**
	 * Toolbar Operations On User Notes
	 *
	 * @param   \AcceptanceTester  $I The AcceptanceTester Object
	 *
	 * @since   4.0.0
	 *
	 * @return  void
	 */
	public function toolbarOperationsUserNote(\AcceptanceTester $I)
	{
		$I->wantToTest('toolbar buttons on user notes - unpublish, publish, archive, trash.');
		$I->doAdministratorLogin();
		$I->amOnPage(UserNotesListPage::$url);
		$I->searchForItem($this->subject);
		$I->click(UserNotesListPage::$option1);
		$I->clickToolbarButton('unpublish');
		// Assertion
		$I->setFilter('select status', 'Unpublished');
		$I->searchForItem($this->subject);
		$I->seeElement(['link' => $this->subject]);
		// Publish
		$I->click(UserNotesListPage::$option1);
		$I->clickToolbarButton('publish');
		// Assertion
		$I->setFilter('select status', 'Published');
		$I->searchForItem($this->subject);
		$I->seeElement(['link' => $this->subject]);
		// Archive
		$I->click(UserNotesListPage::$option1);
		$I->clickToolbarButton('archive');
		// Assertion
		$I->setFilter('select status', 'Archived');
		$I->searchForItem($this->subject);
		$I->seeElement(['link' => $this->subject]);
		// Trash
		$I->click(UserNotesListPage::$option1);
		$I->clickToolbarButton('trash');
		// Assertion
		$I->setFilter('select status', 'Trashed');
		$I->searchForItem($this->subject);
		$I->seeElement(['link' => $this->subject]);
	}
}
