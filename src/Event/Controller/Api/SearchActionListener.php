<?php

namespace App\Event\Controller\Api;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class SearchActionListener extends BaseActionListener
{
    /**
     * Returns a list of all events that the API View endpoint will listen to.
     *
     * @return array
     */
    public function implementedEvents()
    {
        return [
            (string)'Crud.afterPaginate' => 'afterPaginate',
        ];
    }

    /**
     * Attach files to raw search results
     *
     * @param \Cake\Event\Event $event Event instance
     * @return void
     */
    public function afterPaginate(Event $event): void
    {
        if (! property_exists($event->getSubject(), 'entities')) {
            return;
        }

        $entities = $event->getSubject()->entities;
        /** @var \Cake\Datasource\EntityInterface $entity */
        foreach ($entities as $entity) {
            $table = TableRegistry::getTableLocator()->get($entity->getSource());
            $this->attachFiles($entity, $table);
        }
    }
}
