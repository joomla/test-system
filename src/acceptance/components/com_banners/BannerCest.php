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
		$this->bannerTitle = "banner";
		$this->randomBannerTitle = $this->faker->bothify('BannerCest ?##?');
		$this->bannerSuccessMessage = "Banner saved.";
		$this->bannerPublishSuccessMessage = "banner published.";
		$this->bannerUnPublishSuccessMessage = "banner unpublished.";
		$this->bannerCheckinMessage = "banner checked in.";
		$this->bannerTrashMessage = "banner trashed.";
		$this->bannerDeleteMessage = "banner deleted.";
	}

	public function _before(AcceptanceTester $I)
	{
		$I->doAdministratorLogin();
	}

	public function Banner(AcceptanceTester $I, $scenario)
	{
		$I = new BannerStep($scenario);
		$I->createBanner($this->bannerTitle, $this->bannerSuccessMessage);
		$I->modifyBanner($this->bannerTitle, $this->randomBannerTitle, $this->bannerSuccessMessage);
		$I->publishBanner($this->randomBannerTitle, $this->bannerPublishSuccessMessage);
		$I->unpublishBanner($this->randomBannerTitle, $this->bannerUnPublishSuccessMessage);
		$I->checkInBanner($this->randomBannerTitle, $this->bannerCheckinMessage);
		$I->trashBanner($this->randomBannerTitle, $this->bannerTrashMessage);
		$I->deleteBanner($this->randomBannerTitle, $this->bannerDeleteMessage);
	}
}
