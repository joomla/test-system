<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Page\Acceptance\Administrator\MediaManagerPage;

// Test create new folder
// Upload the same image twice
// Rename image to existing image
// Deep link
// State is saved
// Preview
// Download
// Open edit
// Delete folder
// See file information
// See folder information

// Currently not possible to test:
// * drag and drop upload of files
// * select multiple items using keywordboard shortcust (press crtl and click an another item)

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
	 * Runs before every test
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 */
	public function _before(AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
	}

	/**
	 * Runs after every test
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 */
	public function _after(AcceptanceTester $I)
	{
		// Clear localstorage before every test
		$I->executeJS('window.sessionStorage.clear();');
	}

	/**
	 * Test that it loads without php notices and warnings.
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
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
		$I->amOnPage(MediaManagerPage::$url);
		$I->uploadFile('com_media/' . $testFileName);
		$I->seeMessage('Item uploaded.');
		$I->seeContents([$testFileName]);
		// Cleanup
		$I->deleteFile('images/' . $testFileName);
	}

	/**
	 * Test toggle info bar
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
		$I->amOnPage(MediaManagerPage::$url);
		$I->uploadFile('com_media/' . $testFileName);
		$I->waitForElement($testFileItem);
		$I->click($testFileItem);
		$I->click(MediaManagerPage::$toolbarDeleteButton);
		$I->seeMessage('Item deleted.');
		$I->waitForElementNotVisible($testFileItem);
		$I->dontSeeElement($testFileName);
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
		$I->amOnPage(MediaManagerPage::$url);
		$I->uploadFile('com_media/' . $testFileName1);
		$I->waitForElement($testFileItem1);
		$I->uploadFile('com_media/' . $testFileName2);
		$I->waitForElement($testFileItem2);
		$I->click($testFileItem1);
		$I->clickHoldingShiftkey($testFileItem2);
		$I->click(MediaManagerPage::$toolbarDeleteButton);
		$I->seeMessage('Item deleted.');
		$I->waitForElementNotVisible($testFileItem1);
		$I->waitForElementNotVisible($testFileItem2);
		$I->dontSeeElement($testFileItem1);
		$I->dontSeeElement($testFileItem2);
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
		$I->amOnPage(MediaManagerPage::$url);
		$I->uploadFile('com_media/' . $testFileName);
		$I->waitForElement($testFileItem);
		$I->clickOnActionInMenuOf($testFileName, MediaManagerPage::$renameAction);
		$I->seeElement(MediaManagerPage::$modalNameField);
		$I->seeElement(MediaManagerPage::$modalConfirmButton);
		$I->fillField(MediaManagerPage::$modalNameField, 'test-image-1-renamed');
		$I->click(MediaManagerPage::$modalConfirmButton);
		$I->seeMessage('Item renamed.');
		$I->dontSeeElement($testFileItem);
		$I->seeElement(MediaManagerPage::item('test-image-1-renamed.png'));

		// Cleanup
		$I->deleteFile('images/test-image-1-renamed.png');
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
		$I->seeNumberOfElements(MediaManagerPage::$itemSelected, count($this->contents['root']));
	}
}
