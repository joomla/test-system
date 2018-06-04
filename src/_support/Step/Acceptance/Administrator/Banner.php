<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Step
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Step\Acceptance\Administrator;

use Page\Acceptance\Administrator\BannerManagerPage;

/**
 * Acceptance Step object class contains suits for Content Manager.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class Banner extends Admin
{

	public function createBanner($title, $message)
	{
		$I = $this;
		$I->amOnPage(BannerManagerPage::$url);
		$I->clickToolbarButton('New');
		$I->fillField(BannerManagerPage::$titleField, $title);
		$I->clickToolbarButton('Save & Close');
		$I->assertSuccessMessage($message);
	}

	public function assertSuccessMessage($message)
	{
		$I = $this;
		$I->waitForText($message, TIMEOUT, BannerManagerPage::$systemMessageContainer);
		$I->see($message, BannerManagerPage::$systemMessageContainer);
	}

	public function modifyBanner($bannerTitle, $updatedTitle, $message)
	{
		$I = $this;
		$I->amOnPage(BannerManagerPage::$url);
		$I->fillField(BannerManagerPage::$searchField, $bannerTitle);
		$I->click(BannerManagerPage::$filterSearch);
		$I->checkAllResults();
		$I->click($bannerTitle);
		$I->waitForElement(BannerManagerPage::$titleField, TIMEOUT);
		$I->fillField(BannerManagerPage::$titleField, $updatedTitle);
		$I->fillField(BannerManagerPage::$aliasField, $updatedTitle);
		$I->clickToolbarButton('Save & Close');
		$I->assertSuccessMessage($message);
	}

	public function publishBanner($bannerTitle, $message)
	{
		$I = $this;
		$I->amOnPage(BannerManagerPage::$url);
		$I->waitForElement(BannerManagerPage::$searchField, TIMEOUT);
		$I->fillField(BannerManagerPage::$searchField, $bannerTitle);
		$I->Click(BannerManagerPage::$filterSearch);
		$I->checkAllResults();
		$I->clickToolbarButton('Publish');
		$I->assertSuccessMessage($message);
	}

	public function unpublishBanner($bannerTitle, $message)
	{
		$I = $this;
		$I->amOnPage(BannerManagerPage::$url);
		$I->waitForElement(BannerManagerPage::$searchField, TIMEOUT);
		$I->fillField(BannerManagerPage::$searchField, $bannerTitle);
		$I->Click(BannerManagerPage::$filterSearch);
		$I->checkAllResults();
		$I->clickToolbarButton('Unpublish');
		$I->assertSuccessMessage($message);
	}

	public function checkInBanner($bannerTitle, $message)
	{
		$I = $this;
		$I->amOnPage(BannerManagerPage::$url);
		$I->waitForElement(BannerManagerPage::$searchField, TIMEOUT);
		$I->fillField(BannerManagerPage::$searchField, $bannerTitle);
		$I->Click(BannerManagerPage::$filterSearch);
		$I->checkAllResults();
		$I->clickToolbarButton('check-in');
		$I->assertSuccessMessage($message);
	}

	public function trashBanner($bannerTitle, $message)
	{
		$I = $this;
		$I->amOnPage(BannerManagerPage::$url);
		$I->waitForElement(BannerManagerPage::$searchField, TIMEOUT);
		$I->fillField(BannerManagerPage::$searchField, $bannerTitle);
		$I->Click(BannerManagerPage::$filterSearch);
		$I->checkAllResults();
		$I->clickToolbarButton('Trash');
		$I->assertSuccessMessage($message);
	}

	public function deleteBanner($bannerTitle, $message)
	{
		$I = $this;
		$I->amOnPage(BannerManagerPage::$url);
		$I->waitForElement(BannerManagerPage::$searchField, TIMEOUT);
		$I->selectOptionInChosenByIdUsingJs('filter_published', "Trashed");
		$I->fillField(BannerManagerPage::$searchField, $bannerTitle);
		$I->Click(BannerManagerPage::$filterSearch);
		$I->checkAllResults();
		$I->clickToolbarButton('Empty trash');
		$I->acceptPopup();
	}
}