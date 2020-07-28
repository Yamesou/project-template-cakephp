<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ModuleHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;
use Qobo\Utils\Module\ModuleRegistry;

/**
 * App\View\Helper\ModuleHelper Test Case
 */
class ModuleHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ModuleHelper
     */
    public $Module;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Module = new ModuleHelper($view);

        // Make sure the module is loaded with correct class
        ModuleRegistry::getModule('Things');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Module);

        parent::tearDown();
    }

    /**
     * Test table alias
     *
     * @return void
     */
    public function testTableAlias(): void
    {
        $label = $this->Module->tableAlias('Things');
        $this->assertEquals('Things', $label);
    }

    /**
     * Test field label
     *
     * @return void
     */
    public function testFieldLabel(): void
    {
        // Check field which has a field config
        $label = $this->Module->fieldLabel('Things', 'name');
        $this->assertEquals('label name', $label);
    }

    /**
     * Test association label
     *
     * @return void
     */
    public function testAssociationLabel(): void
    {
        // Check association which has a label
        $label = $this->Module->associationLabel('Things', 'PrimaryThingThings');
        $this->assertEquals('Primary Thing Things', $label);

        // Check association which is not a module
        $label = $this->Module->associationLabel('Groups', 'Users');
        $this->assertEquals('Users', $label);
    }
}
