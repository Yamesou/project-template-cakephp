<?php

declare(strict_types=1);

namespace App\Test\TestCase\Event\Plugin\DatabaseLog\Model;

use App\Event\Plugin\DatabaseLog\Model\ExtendDatabaseLogsSelectClauseListener;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class ExtendDatabaseLogsSelectClauseListenerTest extends TestCase
{
    public $fixtures = [
        'app.Things',
        'plugin.DatabaseLog.DatabaseLogs',
    ];

    public function testImplementedEvents(): void
    {
        $this->assertSame(
            ['Model.beforeFind' => 'extendSelectClause'],
            (new ExtendDatabaseLogsSelectClauseListener())->implementedEvents()
        );
    }

    public function testExtendSelectClauseWithDatabaseLogsQueryAsPrimary(): void
    {
        $repository = TableRegistry::getTableLocator()->get('Logs');

        $query = $repository->find()->select('id');

        $expected = ['id'];
        $this->assertSame($expected, $query->clause('select'));

        (new ExtendDatabaseLogsSelectClauseListener())
            ->extendSelectClause(new Event(''), $query, new \ArrayObject(), true);

        $expected = ['id', 'context', 'hostname', 'ip', 'message', 'refer', 'uri'];
        $this->assertSame($expected, $query->clause('select'));
    }

    public function testExtendSelectClauseWithDatabaseLogsQueryAsNonPrimary(): void
    {
        $repository = TableRegistry::getTableLocator()->get('Logs');

        $query = $repository->find()->select('id');

        $expected = ['id'];
        $this->assertSame($expected, $query->clause('select'));

        (new ExtendDatabaseLogsSelectClauseListener())
            ->extendSelectClause(new Event(''), $query, new \ArrayObject(), false);

        $this->assertSame($expected, $query->clause('select'));
    }

    public function testExtendSelectClauseWithNonDatabaseLogsQuery(): void
    {
        $repository = TableRegistry::getTableLocator()->get('Things');

        $query = $repository->find()->select('id');

        $expected = ['id'];
        $this->assertSame($expected, $query->clause('select'));

        (new ExtendDatabaseLogsSelectClauseListener())
            ->extendSelectClause(new Event(''), $query, new \ArrayObject(), true);

        $this->assertSame($expected, $query->clause('select'));
    }
}
