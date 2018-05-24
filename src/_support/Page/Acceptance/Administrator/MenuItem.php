<?php

    /**
     * @package     Joomla.Test
     * @subpackage  AcceptanceTester.Page
     *
     * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
     * @license     GNU General Public License version 2 or later; see LICENSE.txt
     */

    namespace Page\Acceptance\Administrator;

    class MenuItem
    {
        // include url of current page
        public static $url = "administrator/index.php?option=com_menus&view=items";

        /**
         * New User Button
         *
         * @var    string
         * @since  3.7.3
         */
        public static $newButton = ['id' => 'toolbar-new'];

        /**
         * Menu Item Title
         *
         * @var    string
         * @since  3.7.3
         */
        public static $menuItemTitle = ['id' => 'jform_title'];

        /**
         * Menu Item Alias
         *
         * @var    string
         * @since  3.7.3
         */
        public static $menuItemAlias = ['id' => 'jform_alias'];

        /**
         * Menu Item Save
         *
         * @var    string
         * @since  3.7.3
         */
        public static  $saveButton = ['id' => 'toolbar-apply'];

        /**
         * Page title of the user manager listing page.
         *
         * @var    string
         * @since  3.7.3
         */
        public static $pageTitleText = "Menus";


        /**
         * drop down menu
         *
         * @var    string
         * @since  3.7.3
         */
        public static $menuDropDown = ['xpath' => '//select[@id="jform_menutype"]'];

        /**
         * selecting option from dropdown menu
         *
         * @var    string
         * @since  3.7.3
         */
        public static $selectOption = ['xpath' => '//select[@id="jform_menutype"]/option[@value="mainmenu"]'];

        /**
         * check on the checkbox status
         *
         * @var    string
         * @since  __DEPLOY_VERSION__
         */
        public static $checkAll = ['class' => 'hasTooltip'];


        public static $menuTypeModal = ['id' => 'menuTypeModal'];

        public static $articlesLink = ['link' => 'Articles'];

        public static $archiveArticlesLink = ['link' => 'Archived Articles'];

        //$I->clickToolbarButton('rebuild'); didn't work 
        public static $rebuildButton = ['id' => 'toolbar-refresh'];

        public static $successMessage = 'Menu item saved';
    }

