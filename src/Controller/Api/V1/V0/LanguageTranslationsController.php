<?php

namespace App\Controller\Api\V1\V0;

use Cake\Event\Event;
use Cake\Utility\Hash;

class LanguageTranslationsController extends AppController
{
    /**
     * {@inheritDoc}
     */
    public function index()
    {
        $this->Crud->on('beforePaginate', function (Event $event) {
            if (! property_exists($event->getSubject(), 'query')) {
                return;
            }

            $query = $event->getSubject()->query;

            $params = $this->request->getQueryParams();

            if (Hash::get($params, 'model') && Hash::get($params, 'foreign_key')) {
                /**
                 * @var \App\Model\Table\LanguageTranslationsTable $table
                 */
                $table = $this->loadModel();
                $conditions = [
                    'model' => Hash::get($params, 'model'),
                    'foreign_key' => Hash::get($params, 'foreign_key'),
                ];

                if (Hash::get($params, 'field')) {
                    $conditions['field'] = Hash::get($params, 'field');
                }

                if (Hash::get($params, 'language')) {
                    $conditions['language_id'] = $table->getLanguageId(Hash::get($params, 'language'));
                }

                $query->applyOptions(['conditions' => $conditions]);
                $query->applyOptions(['contain' => ['Languages']]);
                $query->applyOptions(['fields' => [
                    $table->aliasField('content'),
                    $table->aliasField('model'),
                    $table->aliasField('foreign_key'),
                    $table->aliasField('field'),
                    'Languages.code',
                ]]);
            } else {
                // In case of missing params to return empty dataset instead of all records
                $query->applyOptions(['conditions' => ['id' => null]]);
            }
        });

        return $this->Crud->execute();
    }
}
