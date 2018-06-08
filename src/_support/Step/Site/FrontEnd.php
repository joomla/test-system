<?php
    namespace Step\Acceptance\Site;

    use Page\Acceptance\Site\FrontPage as FrontPage;

    class FrontEnd extends \AcceptanceTester
    {

        /**
         * Check whether Item is not Visible on front end
         *
         * @param \AcceptanceTester $I
         * @param $menuItemName
         *
         * @return void
         */
        public static function notVisible(\AcceptanceTester $I, $menuItemName)
        {

            $I->comment('Make sure the menu item is not on site After unpublishing it');
            $I->amOnPage(FrontPage::$url);

            $I->dontSee($menuItemName);

        }
        /**
         * Check whether Item is Visible on front end
         *
         * @param \AcceptanceTester $I
         * @param $menuItemName
         *
         * @return void
         */
        public static function isVisible(\AcceptanceTester $I, $menuItemName)
        {

            $I->comment('Check the menu item on site After publishing it');
            $I->amOnPage(FrontPage::$url);

            $I->see($menuItemName);

        }
        /**
         * Check whether Article is Visible on front end
         *
         * @param   \AcceptanceTester $I             Acceptance Tester
         * @param   string            $menuItemName  Menu Item Name
         * @param   string            $articleName   Name Of Article
         *
         * @return void
         */
        public static function articleIsVisible(\AcceptanceTester $I, $menuItemName, $articleName)
        {

            $I->comment('Check the menu item on site After publishing it');
            $I->amOnPage(FrontPage::$url);

            $I->see($menuItemName);
            $I->click(['link' => $menuItemName]);
            $I->see($articleName);

        }
        /**
         * Check whether article is not Visible on front end
         *
         * @param   \AcceptanceTester $I             Acceptance Tester
         * @param   string            $menuItemName  Menu Item Name
         * @param   string            $articleName   Name Of Article
         *
         * @return void
         */
        public static function articleIsNotVisible(\AcceptanceTester $I, $menuItemName, $articleName)
        {

            $I->comment('Check the menu item on site After publishing it');
            $I->amOnPage(FrontPage::$url);

            $I->see($menuItemName);
            $I->click(['link' => $menuItemName]);
            $I->dontSee($articleName);

        }


    }
