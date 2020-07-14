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
            'fields' => [
                'name' => [
                ],
                'foobar' => [
                    'label' => 'Bar Foo',
                ],
            ],
        ];

        $decorator = new FieldNameDecorator();
        $actual = $decorator('Things', $data);

        $this->assertTrue(is_array($actual), 'Invalid return type from the decorator. Expected array.');
        $this->assertArrayHasKey('name', $actual['fields']);
        $this->assertArrayHasKey('label', $actual['fields']['name']);
        $this->assertEquals('Name', $actual['fields']['name']['label']);

        $this->assertArrayHasKey('foobar', $actual['fields']);
        $this->assertArrayHasKey('label', $actual['fields']['foobar']);
        $this->assertEquals('Bar Foo', $actual['fields']['foobar']['label']);
    }
}
