<?php

namespace App\Test\TestCase\Controller;

use Cake\Core\Plugin;
use Cake\TestSuite\IntegrationTestCase;

/**
 * Alt3\Swagger\Controller\DocsController Test Case
 */
class SwaggerDocsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Users',
        'plugin.CsvMigrations.Dblists',
        'plugin.CsvMigrations.DblistItems',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        if (! Plugin::isLoaded('Alt3/Swagger')) {
            $this->markTestSkipped('Swagger plugin is not loaded.');
        }

        $this->get('/swagger/docs');
        $this->assertResponseCode(200);

        $this->get('/swagger/docs/api');
        $this->assertResponseCode(200);

        $this->assertJson($this->_getBodyAsString());
    }
}
