<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Page\Acceptance\Administrator\MediaManagerPage;
use Page\Acceptance\Administrator\MediaManagerFilePage;

// TODO test d&d upload of files
// TODO test download of files
// TODO enable skipped tests

/**
 * Media Manager Tests
 *
 * @since  __DEPLOY_VERSION__
 */
class MediaCest
{
	/**
	 * The default contents
	 *
	 * @var array
	 */
	private $contents = [
		'root'     => [
			'banners',
			'headers',
			'sampledata',
			'joomla_black.png',
			'powered_by.png'
		],
		'/banners' => [
			'banner.jpg',
			'osmbanner1.png',
			'osmbanner2.png',
			'shop-ad.jpg',
			'shop-ad-books.jpg',
			'white.png'
		]
	];

	/**
	 * The name of the test directory, which gets deleted after each test
	 *
	 * @var string
	 */
	private $testDirectory = 'test-dir';

	/**
	 * Runs before every test
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function _before(\Step\Acceptance\Administrator\Media $I)
	{
		$I->doAdministratorLogin();

		// Create the test directory
		$I->createDirectory('images/' . $this->testDirectory);
	}

	/**
	 * Runs after every test
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function _after(\Step\Acceptance\Administrator\Media $I)
	{
		// Delete the test directory
		$I->deleteDirectory('images/' . $this->testDirectory);

		// Clear localstorage before every test
		$I->executeJS('window.sessionStorage.removeItem("' . MediaManagerPage::$storageKey . '");');
	}

	/**
	 * Test that it loads without php notices and warnings.
	 *
	 * @param   AcceptanceTester $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function loadsWithoutPhpNoticesAndWarnings(AcceptanceTester $I)
	{
		$I->wantToTest('that it loads without php notices and warnings.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForText(MediaManagerPage::$pageTitleText);
		$I->checkForPhpNoticesOrWarnings();
	}

	/**
	 * Test that it shows then joomla default media files and folders
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function showsDefaultFilesAndFolders(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it shows the joomla default media files and folders.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->seeElement(MediaManagerPage::$items);
		$I->seeContents($this->contents['root']);
	}

	/**
	 * Test that it shows then joomla default media files and folders
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function showsFilesAndFoldersOfASubdirectoryWhenOpenedUsingDeepLink(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it shows the  media files and folders of a subdirectory when opened using deep link.');
		$I->amOnPage(MediaManagerPage::$url . 'banners');
		$I->waitForMediaLoaded();
		$I->seeElement(MediaManagerPage::$items);
		$I->seeContents($this->contents['/banners']);
	}

	/**
	 * Test that it is possible to select a single file
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function selectSingleFile(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it is possible to select a single file');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->click(MediaManagerPage::item('powered_by.png'));
		$I->seeNumberOfElements(MediaManagerPage::$itemSelected, 1);
	}

	/**
	 * Test that it is possible to select a single file
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function selectSingleFolder(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it is possible to select a single folder');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->click(MediaManagerPage::item('banners'));
		$I->seeNumberOfElements(MediaManagerPage::$itemSelected, 1);
	}

	/**
	 * Test that it is possible to select an image and see the information in the infobar
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function selectMultipleItems(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it is possible to select multiple');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->click(MediaManagerPage::item('banners'));
		$I->clickHoldingShiftkey(MediaManagerPage::item('powered_by.png'));
		$I->seeNumberOfElements(MediaManagerPage::$itemSelected, 2);
	}

	/**
	 * Test that its possible to navigate to a subfolder using double click
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function navigateUsingDoubleClickOnFolder(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that its possible to navigate to a subfolder using double click.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->doubleClick(MediaManagerPage::item('banners'));
		$I->waitForMediaLoaded();
		$I->seeInCurrentUrl(MediaManagerPage::$url . 'banners');
		$I->seeContents($this->contents['/banners']);
	}

	/**
	 * Test that its possible to navigate to a subfolder using tree
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function navigateUsingTree(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that its possible to navigate to a subfolder using tree.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->clickOnLinkInTree('banners');
		$I->waitForMediaLoaded();
		$I->seeInCurrentUrl(MediaManagerPage::$url . 'banners');
		$I->seeContents($this->contents['/banners']);
	}

	/**
	 * Test that its possible to navigate to a subfolder using breadcrumb
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function navigateUsingBreadcrumb(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that its possible to navigate to a subfolder using breadcrumb.');
		$I->amOnPage(MediaManagerPage::$url . 'banners');
		$I->waitForMediaLoaded();
		$I->clickOnLinkInBreadcrumb('images');
		$I->waitForMediaLoaded();
		$I->seeInCurrentUrl(MediaManagerPage::$url);
		$I->seeContents($this->contents['root']);
	}

	/**
	 * Test the upload of a single file using toolbar button.
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function uploadSingleFileUsingToolbarButton(\Step\Acceptance\Administrator\Media $I)
	{
		$testFileName = 'test-image-1.png';

		$I->wantToTest('the upload of a single file using toolbar button.');
		$I->amOnPage(MediaManagerPage::$url . $this->testDirectory);
		$I->uploadFile('com_media/' . $testFileName);
		$I->seeSystemMessage('Item uploaded.');
		$I->seeContents([$testFileName]);
	}

	/**
	 * Test the upload of a single file using toolbar button.
	 *
	 * @skip    We need to skip this test, because of a bug in acceptPopup in chrome.
	 *          Its throws an Facebook\WebDriver\Exception\UnexpectedAlertOpenException and does not accept the popup
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function uploadExistingFileUsingToolbarButton(\Step\Acceptance\Administrator\Media $I)
	{
		$testFileName = 'test-image-1.jpg';

		$I->wantToTest('that it shows a confirmation dialog when uploading existing file.');
		$I->amOnPage(MediaManagerPage::$url . $this->testDirectory);
		$I->uploadFile('com_media/' . $testFileName);
		$I->seeSystemMessage('Item uploaded.');
		$I->uploadFile('com_media/' . $testFileName);
		$I->seeContents([$testFileName]);
		$I->waitForMediaLoaded();
		$I->seeInPopup($testFileName . ' already exists. Do you want to replace it?');
		$I->acceptPopup();
		$I->seeSystemMessage('Item uploaded.');
		$I->seeContents([$testFileName]);
	}

	/**
	 * Test the upload of a single file using toolbar button.
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function createFolderUsingToolbar(\Step\Acceptance\Administrator\Media $I)
	{
		$testFolderName = 'test-folder';

		$I->wantToTest('that it is possible to create a new folder using the toolbar button.');
		$I->amOnPage(MediaManagerPage::$url . $this->testDirectory);
		$I->click(MediaManagerPage::$toolbarCreateFolderButton);
		$I->seeElement(MediaManagerPage::$newFolderInputField);
		$I->seeElement(MediaManagerPage::$modalConfirmButtonDisabled);
		$I->fillField(MediaManagerPage::$newFolderInputField, $testFolderName);
		$I->waitForElementChange(MediaManagerPage::$modalConfirmButton, function (Facebook\WebDriver\Remote\RemoteWebElement $el)  {
			return $el->isEnabled();
		});
		$I->click(MediaManagerPage::$modalConfirmButton);
		$I->seeSystemMessage('Folder created.');
		$I->waitForElement(MediaManagerPage::item($testFolderName));
		$I->seeElement(MediaManagerPage::item($testFolderName));
	}

	/**
	 * Test create an existing folder.
	 *
	 * @skip    Skipping until bug is resolved in media manager
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function createExistingFolderUsingToolbar(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it is not possible to create an existing folder.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->click(MediaManagerPage::$toolbarCreateFolderButton);
		$I->seeElement(MediaManagerPage::$newFolderInputField);
		$I->seeElement(MediaManagerPage::$modalConfirmButtonDisabled);
		$I->fillField(MediaManagerPage::$newFolderInputField, $this->testDirectory);
		$I->waitForElementChange(MediaManagerPage::$modalConfirmButton, function (Facebook\WebDriver\Remote\RemoteWebElement $el)  {
			return $el->isEnabled();
		});
		$I->click(MediaManagerPage::$modalConfirmButton);
		$I->seeSystemMessage('Error creating folder.');
	}

	/**
	 * Test delete single file using toolbar
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function deleteSingleFileUsingToolbar(\Step\Acceptance\Administrator\Media $I)
	{
		$testFileName = 'test-image-1.png';
		$testFileItem = MediaManagerPage::item($testFileName);

		$I->wantToTest('that it is possible to delete a single file.');
		$I->amOnPage(MediaManagerPage::$url . $this->testDirectory);
		$I->uploadFile('com_media/' . $testFileName);
		$I->waitForElement($testFileItem);
		$I->click($testFileItem);
		$I->click(MediaManagerPage::$toolbarDeleteButton);
		$I->seeSystemMessage('Item deleted.');
		$I->waitForElementNotVisible($testFileItem);
		$I->dontSeeElement($testFileName);
	}

	/**
	 * Test toggle info bar
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function deleteSingleFolder(\Step\Acceptance\Administrator\Media $I)
	{
		$testfolderName = 'test-folder';
		$testFolderItem = MediaManagerPage::item($testfolderName);

		$I->wantToTest('that it is possible to delete a single folder.');
		$I->amOnPage(MediaManagerPage::$url . $this->testDirectory);
		$I->createDirectory('images/' . $this->testDirectory . '/' . $testfolderName);
		$I->waitForElement($testFolderItem);
		$I->click($testFolderItem);
		$I->click(MediaManagerPage::$toolbarDeleteButton);
		$I->seeSystemMessage('Item deleted.');
		$I->waitForElementNotVisible($testFolderItem);
		$I->dontSeeElement($testFolderItem);
	}

	/**
	 * Test check all items
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function deleteMultipleFiles(\Step\Acceptance\Administrator\Media $I)
	{
		$testFileName1 = 'test-image-1.png';
		$testFileName2 = 'test-image-1.jpg';
		$testFileItem1 = MediaManagerPage::item($testFileName1);
		$testFileItem2 = MediaManagerPage::item($testFileName2);

		$I->wantToTest('that it is possible to delete a single file.');
		$I->amOnPage(MediaManagerPage::$url . $this->testDirectory);
		$I->uploadFile('com_media/' . $testFileName1);
		$I->waitForElement($testFileItem1);
		$I->uploadFile('com_media/' . $testFileName2);
		$I->waitForElement($testFileItem2);
		$I->click($testFileItem1);
		$I->clickHoldingShiftkey($testFileItem2);
		$I->click(MediaManagerPage::$toolbarDeleteButton);
		$I->seeSystemMessage('Item deleted.');
		$I->waitForElementNotVisible($testFileItem1);
		$I->waitForElementNotVisible($testFileItem2);
		$I->dontSeeElement($testFileItem1);
		$I->dontSeeElement($testFileItem2);
	}

	/**
	 * Test rename a file
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function renameFile(\Step\Acceptance\Administrator\Media $I)
	{
		$testFileName = 'test-image-1.png';
		$testFileItem = MediaManagerPage::item($testFileName);

		$I->wantToTest('that it is possible to rename a file.');
		$I->amOnPage(MediaManagerPage::$url . $this->testDirectory);
		$I->uploadFile('com_media/' . $testFileName);
		$I->waitForElement($testFileItem);
		$I->clickOnActionInMenuOf($testFileName, MediaManagerPage::$renameAction);
		$I->waitForElement(MediaManagerPage::$renameInputField);
		$I->seeElement(MediaManagerPage::$renameInputField);
		$I->seeElement(MediaManagerPage::$modalConfirmButton);
		$I->fillField(MediaManagerPage::$renameInputField, 'test-image-1-renamed');
		$I->click(MediaManagerPage::$modalConfirmButton);
		$I->seeSystemMessage('Item renamed.');
		$I->dontSeeElement($testFileItem);
		$I->seeElement(MediaManagerPage::item('test-image-1-renamed.png'));
	}

	/**
	 * Test rename a file to the same name as an existing file
	 *
	 * @skip    Skipping until bug is resolved in media manager
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function renameFileToExistingFile(\Step\Acceptance\Administrator\Media $I)
	{
		$testFileName1 = 'test-image-1.png';
		$testFileName2 = 'test-image-2.png';
		$testFileItem1 = MediaManagerPage::item($testFileName1);
		$testFileItem2 = MediaManagerPage::item($testFileName2);

		$I->wantToTest('that it is not possible to rename a file to a filename of an existing file.');
		$I->amOnPage(MediaManagerPage::$url . $this->testDirectory);
		$I->uploadFile('com_media/' . $testFileName1);
		$I->waitForElement($testFileItem1);
		$I->uploadFile('com_media/' . $testFileName2);
		$I->waitForElement($testFileItem2);
		$I->clickOnActionInMenuOf($testFileName2, MediaManagerPage::$renameAction);
		$I->seeElement(MediaManagerPage::$renameInputField);
		$I->seeElement(MediaManagerPage::$modalConfirmButton);
		$I->fillField(MediaManagerPage::$renameInputField, 'test-image-1');
		$I->click(MediaManagerPage::$modalConfirmButton);
		$I->seeSystemMessage('Error renaming file.');
		$I->seeElement($testFileItem1);
		$I->seeElement($testFileItem2);
	}

	/**
	 * Test rename a file
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function renameFolder(\Step\Acceptance\Administrator\Media $I)
	{
		$testFolderName = 'test-folder';
		$testFolderItem = MediaManagerPage::item($testFolderName);

		$I->wantToTest('that it is possible to rename a folder.');
		$I->amOnPage(MediaManagerPage::$url . $this->testDirectory);
		$I->createDirectory('images/' . $this->testDirectory . '/' . $testFolderName);
		$I->waitForElement($testFolderItem);
		$I->clickOnActionInMenuOf($testFolderName, MediaManagerPage::$renameAction);
		$I->waitForElement(MediaManagerPage::$renameInputField);
		$I->seeElement(MediaManagerPage::$renameInputField);
		$I->seeElement(MediaManagerPage::$modalConfirmButton);
		$I->fillField(MediaManagerPage::$renameInputField, $testFolderName . '-renamed');
		$I->click(MediaManagerPage::$modalConfirmButton);
		$I->seeSystemMessage('Item renamed.');
		$I->dontSeeElement($testFolderItem);
		$I->seeElement(MediaManagerPage::item($testFolderName . '-renamed'));
	}

	/**
	 * Test rename a folder to the same name as an existing folder
	 *
	 * @skip    Skipping until bug is resolved in media manager
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function renameFolderToExistingFolder(\Step\Acceptance\Administrator\Media $I)
	{
		$testFolderName1 = 'test-folder-1';
		$testFolderName2 = 'test-folder-2';
		$testFolderItem1 = MediaManagerPage::item($testFolderName1);
		$testFolderItem2 = MediaManagerPage::item($testFolderName2);

		$I->wantToTest('that it is not possible to rename a folder to a foldername of an existing folder.');
		$I->amOnPage(MediaManagerPage::$url . $this->testDirectory);
		$I->createDirectory('images/' . $this->testDirectory . '/' . $testFolderName1);
		$I->waitForElement($testFolderItem1);
		$I->createDirectory('images/' . $this->testDirectory . '/' . $testFolderName2);
		$I->waitForElement($testFolderItem2);
		$I->clickOnActionInMenuOf($testFolderName2, MediaManagerPage::$renameAction);
		$I->seeElement(MediaManagerPage::$renameInputField);
		$I->seeElement(MediaManagerPage::$modalConfirmButton);
		$I->fillField(MediaManagerPage::$renameInputField, $testFolderName1);
		$I->click(MediaManagerPage::$modalConfirmButton);
		$I->seeSystemMessage('Error renaming folder.');
		$I->seeElement($testFolderItem1);
		$I->seeElement($testFolderItem2);
	}

	/**
	 * Test preview using double click on image
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function showPreviewUsingDoubleClickOnImage(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it shows a preview for image when user doubleclicks it.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->doubleClick(MediaManagerPage::item('powered_by.png'));
		$I->waitForElement(MediaManagerPage::$previewModal);
		$I->seeElement(MediaManagerPage::$previewModal);
		$I->see('powered_by.png', MediaManagerPage::$previewModal);
		$I->seeElement(MediaManagerPage::$previewModalImg);
		$I->seeElement(MediaManagerPage::$previewModalCloseButton);
	}

	/**
	 * Test preview using action menu
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function showPreviewUsingClickOnActionMenu(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it is possible to show a preview of an image using button in action menu.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->clickOnActionInMenuOf('powered_by.png', MediaManagerPage::$previewAction);
		$I->waitForElement(MediaManagerPage::$previewModal);
		$I->seeElement(MediaManagerPage::$previewModal);
		$I->see('powered_by.png', MediaManagerPage::$previewModal);
		$I->seeElement(MediaManagerPage::$previewModalImg);
		$I->seeElement(MediaManagerPage::$previewModalCloseButton);
	}

	/**
	 * Test close the preview modal
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function closePreviewModalUsingCloseButton(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that its possible to close the preview modal using the close button.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->doubleClick(MediaManagerPage::item('powered_by.png'));
		$I->waitForElement(MediaManagerPage::$previewModal);
		$I->seeElement(MediaManagerPage::$previewModalCloseButton);
		$I->click(MediaManagerPage::$previewModalCloseButton);
		$I->dontSeeElement(MediaManagerPage::$previewModal);
	}

	/**
	 * Test close the preview modal
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function closePreviewModalUsingEscapeKey(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that its possible to close the preview modal using escape key.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->doubleClick(MediaManagerPage::item('powered_by.png'));
		$I->waitForElement(MediaManagerPage::$previewModal);
		$I->pressKey('body', \Facebook\WebDriver\WebDriverKeys::ESCAPE);
		$I->dontSeeElement(MediaManagerPage::$previewModal);
	}

	/**
	 * Test rename a file
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function openImageEditorUsingActionMenu(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it is possible to open the image editor using action menu.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->clickOnActionInMenuOf('powered_by.png', MediaManagerPage::$editAction);
		$I->seeInCurrentUrl(MediaManagerFilePage::$url . '&path=local-0:/powered_by.png');
	}

	/**
	 * Test toggle info bar
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function toggleInfoBar(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it is possible to toggle the infobar.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->openInfobar();
		$I->seeElement(MediaManagerPage::$infoBar);
		$I->closeInfobar();
		$I->waitForElementNotVisible(MediaManagerPage::$infoBar);
		$I->dontSeeElement(MediaManagerPage::$infoBar);
	}

	/**
	 * Test show file information in infobar
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function showFileInformationInInfobar(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it shows basic file information in the infobar.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->click(MediaManagerPage::item('powered_by.png'));
		$I->openInfobar();
		$I->see('powered_by.png', MediaManagerPage::$infoBar);
		$I->see('image/png', MediaManagerPage::$infoBar);
	}

	/**
	 * Test show folder information in infobar
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function showFolderInformationInInfobar(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it shows basic folder information in the infobar.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->click(MediaManagerPage::item('banners'));
		$I->openInfobar();
		$I->see('banners', MediaManagerPage::$infoBar);
		$I->see('directory', MediaManagerPage::$infoBar);
	}

	/**
	 * Test resize the thumbnails
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function resizeThumbnails(\Step\Acceptance\Administrator\Media $I) {
		$I->wantToTest('that it is possible to resize the thumbnails.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		// Resize to max
		$I->seeElement(MediaManagerPage::$itemsContainerMedium);
		$I->click(MediaManagerPage::$increaseThumbnailSizeButton);
		$I->seeElement(MediaManagerPage::$itemsContainerLarge);
		$I->click(MediaManagerPage::$increaseThumbnailSizeButton);
		$I->seeElement(MediaManagerPage::$itemsContainerExtraLarge);
		$I->seeElement(MediaManagerPage::$increaseThumbnailSizeButtonDisabled);
		// Resize to min
		$I->click(MediaManagerPage::$decreaseThumbnailSizeButton);
		$I->seeElement(MediaManagerPage::$itemsContainerLarge);
		$I->click(MediaManagerPage::$decreaseThumbnailSizeButton);
		$I->seeElement(MediaManagerPage::$itemsContainerMedium);
		$I->click(MediaManagerPage::$decreaseThumbnailSizeButton);
		$I->seeElement(MediaManagerPage::$itemsContainerSmall);
		$I->click(MediaManagerPage::$decreaseThumbnailSizeButton);
		$I->seeElement(MediaManagerPage::$itemsContainerExtraSmall);
		$I->seeElement(MediaManagerPage::$decreaseThumbnailSizeButtonDisabled);
	}

	/**
	 * Test table view
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function toggleListViewUsingToolbarButton(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that its possible to toggle the list view (grid/table) using the toolbar button.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->seeElement(MediaManagerPage::$mediaBrowserGrid);
		$I->seeElement(MediaManagerPage::$toggleListViewButton);
		$I->click(MediaManagerPage::$toggleListViewButton);
		$I->dontSeeElement(MediaManagerPage::$increaseThumbnailSizeButton);
		$I->dontSeeElement(MediaManagerPage::$decreaseThumbnailSizeButton);
		$I->seeElement(MediaManagerPage::$mediaBrowserTable);
		$I->click(MediaManagerPage::$toggleListViewButton);
		$I->seeElement(MediaManagerPage::$mediaBrowserGrid);
	}

	/**
	 * Test check all items
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function selectAllItemsUsingToolbarButton(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that its possible to select all items using toolbar button.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$I->click(MediaManagerPage::$selectAllButton);
		$I->seeNumberOfElements(MediaManagerPage::$itemSelected, count($this->contents['root']) + 1);
	}

	/**
	 * Test that the app state is synced with session storage
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function synchronizeAppStateWithSessionStorage(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that the application state is synchronized with session storage.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForMediaLoaded();
		$json = $I->executeJS('return sessionStorage.getItem("' . MediaManagerPage::$storageKey . '")');
		$I->assertContains('"selectedDirectory":"local-0:/"', $json);
		$I->assertContains('"showInfoBar":false', $json);
		$I->assertContains('"listView":"grid"', $json);
		$I->assertContains('"gridSize":"md"', $json);
		$I->clickOnLinkInTree('banners');
		$I->waitForMediaLoaded();
		$I->openInfobar();
		$I->click(MediaManagerPage::$increaseThumbnailSizeButton);
		$I->click(MediaManagerPage::$toggleListViewButton);
		$json = $I->executeJS('return sessionStorage.getItem("' . MediaManagerPage::$storageKey . '")');
		$I->assertContains('"selectedDirectory":"local-0:/banners"', $json);
		$I->assertContains('"showInfoBar":true', $json);
		$I->assertContains('"listView":"table"', $json);
		$I->assertContains('"gridSize":"lg"', $json);
	}
}
