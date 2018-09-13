<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace administrator\components\com_extensions;
use Page\Acceptance\Administrator\moduleList as ModuleList;
use Step\Acceptance\Administrator\moduleStep as ModuleStep;
use Page\Acceptance\Administrator;
use Faker\Factory as fakerLib;
/**
 * Module class
 *
 * @category  extension
 * @package   Administrator/components/com_extension
 * @author    Samarth sharma <samarthsharma351@gmail.com>
 * @copyright 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license   Joomla 2005-2018
 * @link      Modules
 * @since     __DEPLOYED_VERSION
 */
class moduleCest
{
    /**
     * moduleCest constructor.
     *
     * @var   string $moduleName  Name of the module
     * @var   string $category    Category
     *
     * @return void
     */
    public function __construct()
    {
        $faker = fakerLib::create();
        // Initialize Variables
        $this->moduleName = $faker->name;
        $this->category   = 'Google Summer Of Codes';
    }
    /**
     * All Module Type Tests
     *
     * @param   \AcceptanceTester $I          Acceptance Tester
     * @param   string            $scenario   Scenario
     *
     * @return void
     */
    public function allModuleTypes(\AcceptanceTester $I)
    {
        $I->wantToTest('All Module Types');
        /**
         * Module Types You can chose. Make sure you put these exactly as parameters
         * Articles - Archived
         * Articles - Categories
         * Articles - Category
         * Banners
         * Breadcrumbs
         * Articles - Most Read
         * Articles - Newsflash
         * Articles - Related
         * Custom
         * Feed Display
         * Latest Users
         * Login
         * Search
         * Smart Search
         * Language Switcher
         * Menu
         * Statistics
         * Syndication Feeds
         * Tags - Popular
         */
        // Articles - Archived
        $I->createModule('Articles - Archived', $this->moduleName.' Archived Articles', $this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Archived Articles');

        // Articles - Categories
        $I->createModule('Articles - Categories', $this->moduleName.' Articles Categories', $this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Articles Categories');

        // Articles - Category
        $I->createModule('Articles - Category', $this->moduleName.' Article Category', $this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Article Category');

        // Articles - Latest
        $I->createModule('Articles - Latest', $this->moduleName.' Article Latest', $this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I,$this->moduleName.' Article Latest');

        // Articles - Newsflash
        $I->createModule('Articles - Newsflash', $this->moduleName.' Article Newsflash', $this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Article Newsflash');

        // Articles - Most Read
        $I->createModule('Articles - Most Read', $this->moduleName.' Article Read Most', $this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Article Read Most');

        // Banners
        $I->createModule('Banners', $this->moduleName.' Article Banners', $this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Article Banners');

        // Custom
        $I->createModule('Custom', $this->moduleName.' Article Custom', $this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Article Custom');

        // Breadcrumbs
        $I->createModule('Breadcrumbs', $this->moduleName.' Breadcrumbs', $this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Breadcrumbs');

        // Articles - Related
        $I->createModule('Articles - Related', $this->moduleName.' Article Related', $this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Article Related');

        // Language Switcher
        $I->createModule('Language Switcher' , $this->moduleName.' Language Switcher',$this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Language Switcher');

        // Search
        $I->createModule('Search' , $this->moduleName.' Searching',$this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Searching');

        // Smart Search
        $I->createModule('Smart Search' , $this->moduleName.' Smart Search',$this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Smart Search');

        // Menu
        $I->createModule('Menu' , $this->moduleName.' Menu',$this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Menu');

        // Statistics
        $I->createModule('Statistics' , $this->moduleName.' Statistics',$this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Statistics');

        // Login
        $I->createModule('Login' , $this->moduleName.' Login',$this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Login');

        // Latest Users
        $I->createModule('Latest Users' , $this->moduleName.' Latest Users',$this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Latest Users');

        // Syndication Feeds
        $I->createModule('Syndication Feeds' , $this->moduleName.' Syndication Feeds',$this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Syndication Feeds');

        // Tags - Popular
        $I->createModule('Tags - Popular' , $this->moduleName.' Tags - Popular',$this->category);
        // Perform all toolbar
        ModuleStep::applyToolbarButtonsOnModule($I, $this->moduleName.' Tags - Popular');
    }









}
