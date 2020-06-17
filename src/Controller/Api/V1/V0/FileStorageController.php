<?php

namespace App\Controller\Api\V1\V0;

use App\Service\OrderFileStorage;
use Cake\ORM\TableRegistry;

class FileStorageController extends AppController
{
    /**
     * Update File Order function shared among API controllers
     *
     * @return \Cake\Http\Response|void|null
     */
    public function order()
    {
        $this->request->allowMethod(['ajax', 'post']);

        $data = (array)$this->request->getData();

        $result = OrderFileStorage::orderFiles($data);

        $this->set('result', $result);
        $this->set('_serialize', 'result');
    }
}
