<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Step\Acceptance\Administrator\Banner as BannerStep;
use Page\Acceptance\Administrator\BannerManagerPage;

class BannerCest
{
	public function __construct()
	{
		$this->faker = Faker\Factory::create();
		$this->userName = $this->faker->bothify('UserNameCheckoutProductCest ?##?');
		$this->bannerTitle = $this->faker->bothify('banner ##??');
		$this->randomBannerTitle = $this->faker->bothify('BannerCest ?##?');
		$this->bannerSuccessMessage = "Banner saved.";
		$this->bannerPublishSuccessMessage = "published.";
		$this->bannerUnPublishSuccessMessage = "unpublished.";
		$this->bannerTrashMessage = "trashed.";
		$this->bannerDeleteMessage = "deleted.";
	}

	public function _before(AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
	}

	public function testCreateBanner(AcceptanceTester $I, $scenario)
	{
		$I = new BannerStep($scenario);
		$I->createBanner($this->bannerTitle, $this->bannerSuccessMessage);
	}

	public function testModifyBanner(AcceptanceTester $I, $scenario)
	{
		$I = new BannerStep($scenario);
		$I->modifyBanner($this->bannerTitle, $this->randomBannerTitle, $this->bannerSuccessMessage);
	}

	public function testStatusChangeBanner(AcceptanceTester $I, $scenario)
	{
		$I = new BannerStep($scenario);
		$I->publishBanner($this->randomBannerTitle, $this->bannerPublishSuccessMessage);
		$I->unpublishBanner($this->randomBannerTitle, $this->bannerUnPublishSuccessMessage);
	}

	public function testTrashBanner(AcceptanceTester $I, $scenario)
	{
		$I = new BannerStep($scenario);
		$I->trashBanner($this->randomBannerTitle, $this->bannerTrashMessage);
		$I->deleteBanner($this->randomBannerTitle, $this->bannerDeleteMessage);
	}
}
