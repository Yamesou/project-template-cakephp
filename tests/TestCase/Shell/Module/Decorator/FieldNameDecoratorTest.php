<?php
namespace App\Test\TestCase\Shell\Module\Decorator;

use App\Shell\Module\Decorator\FieldNameDecorator;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\Module\Decorator\FieldNameDecorator Test Case
 */
class FieldNameDecoratorTest extends TestCase
{
    /**
     * Test decorator invokation
     *
     * @return void
     */
    public function testInvoke(): void
    {
        $data = [
            'migration' => [
                'test_field' => [],
                'foo_bar' => [],
            ],
            'fields' => [
                'foo_bar' => [
                    'label' => 'Bar Foo',
                ],
            ],
        ];

        $decorator = new FieldNameDecorator();
        $actual = $decorator('Things', $data);

        $this->assertTrue(is_array($actual), 'Invalid return type from the decorator. Expected array.');
        $this->assertArrayHasKey('test_field', $actual['fields']);
        $this->assertArrayHasKey('label', $actual['fields']['test_field']);
        $this->assertEquals('Test Field', $actual['fields']['test_field']['label']);

        $this->assertArrayHasKey('foo_bar', $actual['fields']);
        $this->assertArrayHasKey('label', $actual['fields']['foo_bar']);
        $this->assertEquals('Bar Foo', $actual['fields']['foo_bar']['label']);
    }
}
