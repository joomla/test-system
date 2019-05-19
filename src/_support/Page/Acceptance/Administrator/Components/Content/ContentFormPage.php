<?php
/**
 * @package     Joomla.Test
 * @subpackage  AcceptanceTester.Page
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Page\Acceptance\Administrator\Components\Content;

use Page\Acceptance\Administrator\AdminFormPage;

/**
 * Class ContentFormPage
 * @package Page\Acceptance\Administrator\Components\Content
 */
class ContentFormPage extends AdminFormPage
{
	/**
	 * Link to the article form page.
	 *
	 * @var string
	 */
	public static $url = 'administrator/index.php?option=com_content&view=article&layout=edit';
}
