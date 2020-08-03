<?php
namespace App\Test\TestCase\Shell\Module\Decorator;

use App\Shell\Module\Decorator\AssociationLabelsDecorator;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\Module\Decorator\AssociationLabelsDecorator Test Case
 */
class AssociationLabelsDecoratorTest extends TestCase
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
                'associationLabels' => [],
            ],
        ];

        $decorator = new AssociationLabelsDecorator();
        $actual = $decorator('Things', $data);

        $this->assertTrue(is_array($actual), 'Invalid return type from the decorator. Expected array.');
        $this->assertArrayHasKey('AssignedToUsers', $actual['config']['associationLabels']);
    }
}
