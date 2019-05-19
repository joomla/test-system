<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Page\Acceptance;

use AcceptanceTester;

/**
 * Acceptance Page object class to define joomla page objects.
 *
 * @package  Page\Acceptance
 */
class JoomlaPage {

	/**
	 * @var AcceptanceTester
	 */
	protected $tester;

	/**
	 * JoomlaPage constructor.
	 *
	 * @param AcceptanceTester $tester
	 */
	public function __construct(AcceptanceTester $tester)
	{
		$this->tester = $tester;
	}
}
