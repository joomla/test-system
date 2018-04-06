<?php namespace Page\Acceptance\Administrator;

/**
 * Acceptance Page object class to define administrator form page objects.
 *
 * @package  Page\Acceptance\Administrator
 *
 * @since    __DEPLOY_VERSION__
 */
class AdminFormPage extends AdminPage
{
	/**
	 * Get a joomla form field name
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	public static function formFieldName(string $name): string
	{
		return 'jform[' . $name . ']';
	}
}
