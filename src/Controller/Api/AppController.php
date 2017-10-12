<?php
namespace App\Controller\Api;

use Cake\Network\Exception\ForbiddenException;
use CsvMigrations\Controller\Api\AppController as BaseController;
use RolesCapabilities\CapabilityTrait;

class AppController extends BaseController
{
    use CapabilityTrait;

    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        parent::initialize();

        $hasAccess = $this->_checkAccess($this->request->params, $this->Auth->user());

        if (!$hasAccess) {
            throw new ForbiddenException();
        }
    }
}
