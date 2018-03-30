<?php namespace Step\Acceptance\Administrator;

use Page\Acceptance\Administrator\MediaManagerPage;

/**
 * Acceptance Step object class contains suits for Media Manager.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class Media extends Admin
{
	/**
	 * Helper function to wait for the media manager to load the data
	 *
	 * @param AcceptanceTester $I
	 */
	public function waitForMediaLoaded()
	{
		$I = $this;
		$I->waitForElement(['class' => 'media-loader']);
		$I->waitForElementNotVisible(['class' => 'media-loader']);
	}

	/**
	 * Helper function that tests that you see contents of a directory
	 *
	 * @param array $contents
	 */
	public function seeContents(array $contents = [])
	{
		$I = $this;
		$I->seeElement(MediaManagerPage::$items);
		foreach ($contents as $content)
		{
			$I->see($content, MediaManagerPage::$items);
		}
	}
}
