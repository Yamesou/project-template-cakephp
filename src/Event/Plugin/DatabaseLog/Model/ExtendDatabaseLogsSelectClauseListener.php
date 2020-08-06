<?php

declare(strict_types=1);

namespace App\Event\Plugin\DatabaseLog\Model;

use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
use Cake\ORM\Query;
use DatabaseLog\Model\Table\DatabaseLogsTable;

final class ExtendDatabaseLogsSelectClauseListener implements EventListenerInterface
{
    /** {@inheritDoc} */
    public function implementedEvents()
    {
        return ['Model.beforeFind' => 'extendSelectClause'];
    }

    /** {@inheritDoc} */
    public function extendSelectClause(Event $event, Query $query, \ArrayObject $options, bool $primary): void
    {
        if ($primary && $query->repository() instanceof DatabaseLogsTable) {
            $query->select(['context', 'hostname', 'ip', 'message', 'refer', 'uri']);
        }
    }
}
