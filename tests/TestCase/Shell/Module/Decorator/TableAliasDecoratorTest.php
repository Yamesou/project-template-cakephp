<?php
namespace App\Test\TestCase\Shell\Module\Decorator;

use App\Shell\Module\Decorator\TableAliasDecorator;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\Module\Decorator\TableAliasDecorator Test Case
 */
class TableAliasDecoratorTest extends TestCase
{
    /**
     * Test decorator invokation
     *
     * @return void
     */
    public function testInvoke(): void
    {
        $data = [
            'config' => [
                'table' => [],
            ],
        ];

        $decorator = new TableAliasDecorator();
        $actual = $decorator('Things', $data);

        $this->assertTrue(is_array($actual), 'Invalid return type from the decorator. Expected array.');
        $this->assertArrayHasKey('alias', $actual['config']['table']);
        $this->assertEquals('Things', $actual['config']['table']['alias']);
    }
}
