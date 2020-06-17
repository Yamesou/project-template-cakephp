<?php
namespace App\Test\TestCase\Service;

use App\Service\OrderFileStorage;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Hash;
use Webmozart\Assert\Assert;

class OrderFileStorageTest extends TestCase
{
    public $fixtures = [
        'app.things',
        'app.users',
        'app.file_storage',
    ];

    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testOrderFiles(): void
    {
        $table = TableRegistry::getTableLocator()->get('FileStorage');

        $files = $table->find()->all();

        $filesToOrder = [
            [
                'key' => 'file-storage-1',
            ],
            [
                'key' => 'file-storage-2',
            ],
            [
                'key' => 'file-storage-3',
            ],
            [
                'key' => 'file-storage-4',
            ],
        ];

        $expected = [
            'file-storage-1' => 0,
            'file-storage-2' => 1,
            'file-storage-3' => 2,
            'file-storage-4' => 3,
        ];

        $result = OrderFileStorage::orderFiles($filesToOrder);
        $this->assertTrue($result['success']);

        $files = $table->find()->all();
        $sortedFiles = [];
        foreach ($files as $file) {
            $sortedFiles[$file->id] = $file->order;
        }

        $this->assertSame($expected, $sortedFiles);
    }

    public function testOrderFilesFailed(): void
    {
        $table = TableRegistry::getTableLocator()->get('FileStorage');

        $files = $table->find()->all();

        $filesToOrder = [];

        $result = OrderFileStorage::orderFiles($filesToOrder);
        $this->assertFalse($result['success']);

        $files = $table->find()->all();
    }
}
