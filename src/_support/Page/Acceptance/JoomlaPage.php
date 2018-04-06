<?php

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
