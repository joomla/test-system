<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Page\Acceptance\Administrator\MediaManagerPage;

// Test delete file
// Test rename file
// Test navigate using tree
// Test navigate using breadcrumb
// Test it shows infobar
// Test resize buttons
// Test table/grid view
// Test checkall
// Test check multiple items
// test batch delete
// Test create new folder
// Upload the same image twice
// Rename image to existing image
// Deep link
// State is saved

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
		$I->doubleClick(MediaManagerPage::$bannersFolder . MediaManagerPage::$itemPreview);
		$I->waitForMediaLoaded();
		$I->seeInCurrentUrl(MediaManagerPage::$url . 'banners');
		$I->seeContents($this->contents['/banners']);
	}

	/**
	 * Test that it is possible to select an image and see the information in the infobar
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function selectImageAndCheckTheInformation(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('the media manager overview information method');
		$I->amOnPage(MediaManagerPage::$url);
		$I->waitForElement(MediaManagerPage::$poweredByImage);
		$I->click(MediaManagerPage::$poweredByImage);
		$I->openInfobar();
		$I->seeElement(MediaManagerPage::$infoBar);
		$I->see('powered_by.png',MediaManagerPage::$infoBar);
		$I->see('image/png', MediaManagerPage::$infoBar);
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
	 * Test open infobar
	 *
	 * @param   \Step\Acceptance\Administrator\Media $I Acceptance Helper Object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function openInfoBar(\Step\Acceptance\Administrator\Media $I)
	{
		$I->wantToTest('that it is possible to open the infobar.');
		$I->amOnPage(MediaManagerPage::$url);
		$I->openInfobar();
		$I->seeElement(MediaManagerPage::$infoBar);
	}
}
