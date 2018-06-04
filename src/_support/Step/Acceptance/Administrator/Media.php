<?php namespace Step\Acceptance\Administrator;

use Codeception\Configuration;
use Page\Acceptance\Administrator\MediaManagerPage;
use Codeception\Util\FileSystem as Util;

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
	 * @since   __DEPLOY_VERSION__
	 */
	public function waitForMediaLoaded()
	{
		$I = $this;
		$I->waitForElement(MediaManagerPage::$loader);
		$I->waitForElementNotVisible(MediaManagerPage::$loader);
		// Add a small timeout to wait for rendering (otherwise it will fail when executed in headless browser)
		$I->wait(0.2);
	}

	/**
	 * Helper function that tests that you see contents of a directory
	 *
	 * @param array $contents
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function seeContents(array $contents = [])
	{
		$I = $this;
		$I->seeElement(MediaManagerPage::$items);
		foreach ($contents as $content)
		{
			$I->seeElement(MediaManagerPage::item($content));
		}
	}

	/**
	 * Helper function to upload a file in the current directory
	 *
	 * @param  string  $fileName
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function uploadFile($fileName)
	{
		$I = $this;
		$I->seeElementInDOM(MediaManagerPage::$fileInputField);
		$I->attachFile(MediaManagerPage::$fileInputField, $fileName);
	}

	/**
	 * Delete a file from filesystem
	 *
	 * @param  string  $path
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function deleteFile($path)
	{
		$I = $this;
		$absolutePath = $this->absolutizePath($path);
		if (!file_exists($absolutePath)) {
			\PHPUnit\Framework\Assert::fail('file not found.');
		}
		unlink($absolutePath);
		$I->comment('Deleted ' . $absolutePath);
	}

	/**
	 * Deletes directory with all subdirectories
	 *
	 * @param   string  $dirname
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function createDirectory($dirname)
	{
		$I = $this;
		$absolutePath = $this->absolutizePath($dirname);
		@mkdir($absolutePath);
		$I->comment('Created ' . $absolutePath);
	}

	/**
	 * Deletes directory with all subdirectories
	 *
	 * @param   string  $dirname
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function deleteDirectory($dirname)
	{
		$I = $this;
		$absolutePath = $this->absolutizePath($dirname);
		Util::deleteDir($absolutePath);
		$I->comment('Deleted ' . $absolutePath);
	}

	/**
	 * Click on a link in the media tree
	 *
	 * @param   string  $link
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function clickOnLinkInTree($link) {
		$I = $this;
		$I->click($link, MediaManagerPage::$mediaTree);
	}

	/**
	 * Click on a link in the media breadcrumb
	 *
	 * @param   string  $link
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function clickOnLinkInBreadcrumb($link) {
		$I = $this;
		$I->click($link, MediaManagerPage::$mediaBreadcrumb);
	}

	/**
	 * Open the item actions menu of an item
	 *
	 * @param   string  $itemName
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function openActionsMenuOf($itemName)
	{
		$I = $this;
		$toggler = MediaManagerPage::itemActionMenuToggler($itemName);
		$I->moveMouseOver(MediaManagerPage::item($itemName));
		$I->seeElement($toggler);
		$I->click($toggler);
	}

	/**
	 * Open the item actions menu and click on one action
	 *
	 * @param   string  $itemName
	 * @param   string  $actionName
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function clickOnActionInMenuOf($itemName, $actionName)
	{
		$I = $this;
		$action = MediaManagerPage::itemAction($itemName,$actionName);
		$I->openActionsMenuOf($itemName);
		$I->waitForElementVisible($action);
		$I->click($action);
	}

	/**
	 * Helper function to open the media manager info bar
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function openInfobar() {
		$I = $this;
		try {
			$I->seeElement(MediaManagerPage::$infoBar);
		} catch (\Exception $e) {
			$I->click(MediaManagerPage::$toggleInfoBarButton);
		}
	}

	/**
	 * Helper function to close the media manager info bar
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function closeInfobar() {
		$I = $this;
		try {
			$I->seeElement(MediaManagerPage::$infoBar);
			$I->click(MediaManagerPage::$toggleInfoBarButton);
		} catch (\Exception $e) {
			// Do nothing
		}
	}

	/**
	 * Click on an element holding shift key
	 *
	 * @param   string $xpath  Xpath selector
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function clickHoldingShiftkey($xpath)
	{
		$I = $this;
		$I->executeInSelenium(function(\Facebook\WebDriver\Remote\RemoteWebDriver $webdriver) use ($xpath) {
			$element = $webdriver->findElement(\Facebook\WebDriver\WebDriverBy::xpath($xpath));
			$action = new \Facebook\WebDriver\Interactions\WebDriverActions($webdriver);
			$shiftKey = \Facebook\WebDriver\WebDriverKeys::SHIFT;
			$action->keyDown(null, $shiftKey)
				->click($element)
				->keyUp(null, $shiftKey)
				->perform();
		});
	}

	/**
	 * Get the absoluute path
	 *
	 * @param   string $path
	 *
	 * @since   __DEPLOY_VERSION__
	 *
	 * @return string
	 */
	protected function absolutizePath($path)
	{
		return Configuration::projectDir() . 'test-install/' . ltrim($path,'/');
	}
}
