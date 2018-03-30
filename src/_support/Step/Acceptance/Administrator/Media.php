<?php namespace Step\Acceptance\Administrator;

use Codeception\Configuration;
use Page\Acceptance\Administrator\MediaManagerPage;
use PHPUnit_Framework_Exception;

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
	 */
	public function waitForMediaLoaded()
	{
		$I = $this;
		$I->waitForElement(['class' => 'media-loader']);
		$I->waitForElementNotVisible(['class' => 'media-loader']);
	}

	/**
	 * Helper function to open the media manager info bar
	 */
	public function openInfobar() {
		$I = $this;
		try {
			$I->seeElement(MediaManagerPage::$infoBar);
		} catch (PHPUnit_Framework_Exception $e) {
			$I->click(MediaManagerPage::$toggleInfoBarButton);
		}
	}

	/**
	 * Helper function to close the media manager info bar
	 */
	public function closeInfobar() {
		$I = $this;
		try {
			$I->seeElement(MediaManagerPage::$infoBar);
			$I->click(MediaManagerPage::$toggleInfoBarButton);
		} catch (PHPUnit_Framework_Exception $e) {
			// Do nothing
		}
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

	/**
	 * Helper function to upload a file in the current directory
	 *
	 * @param  string  $fileName
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
	 * Get the absoluute path
	 *
	 * @param   string $path
	 * @return string
	 */
	protected function absolutizePath($path)
	{
		return Configuration::projectDir() . 'test-install/' . ltrim($path,'/');
	}
}
