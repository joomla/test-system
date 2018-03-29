<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Step
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Step\Acceptance\Administrator;

use Page\Acceptance\Administrator\AdminPage;
use Page\Acceptance\Administrator\LoginPage;

/**
 * Acceptance Step object class for admin steps.
 *
 * @package  Step\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class Admin extends \AcceptanceTester
{
	/**
	 * Login in backend
	 *
	 * @param   string  $username
	 * @param   string  $password
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function login($username = 'admin', $password = 'admin', $force = true)
	{
		$I = $this;
		if ($I->loadSessionSnapshot('adminLogin'))
		{
			return;
		}
		$I->wantTo('login in backend');
		$I->amOnPage(LoginPage::$url);
		$I->waitForElement(LoginPage::$form);
		$I->submitForm(LoginPage::$form, [
			'username' => $username,
			'passwd'   => $password,
		]);
		$I->see('Control Panel', 'h1.page-title');
		$I->saveSessionSnapshot('adminLogin');
	}

	/**
	 * Method to confirm message appear
	 *
	 * @param   string $message The message to be confirm
	 *
	 * @since   __DEPLOY_VERSION__
	 *
	 * @return  void
	 */
	public function iShouldSeeTheMessage($message)
	{
		$I = $this;

		$I->waitForText($message, TIMEOUT, AdminPage::$systemMessageContainer);
		$I->see($message, AdminPage::$systemMessageContainer);
	}
}
