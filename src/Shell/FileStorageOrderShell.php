<?php

/**
 * This shell can be executed by running the following console command
 * bin/cake FileStorageOrder -m <Module> -f <file-field> -c <current-order-field> -d asc
 */

namespace App\Shell;

use CakeDC\Users\Shell\UsersShell as BaseShell;
use Cake\Console\ConsoleOptionParser;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use CsvMigrations\Utility\FileUpload;
use Qobo\Utils\ModuleConfig\Parser\Parser;
use Qobo\Utils\Module\ModuleRegistry;

class FileStorageOrderShell extends BaseShell
{
    /**
     * @var string
     */
    private $module;

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $currentOrderField;

    /**
     * @var string
     */
    private $currentOrderFieldDirection;

    /**
     * @var string
     */
    private const NEW_ORDER_FIELD = 'order';

    /**
     * Set shell description and command line options
     *
     * @return ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = new ConsoleOptionParser('console');
        $parser->setDescription('Order FileStorage Files');
        $parser->addOption('module', [
            'short' => 'm',
            'help' => 'Module',
        ]);
        $parser->addOption('field', [
            'short' => 'f',
            'help' => 'Order field',
        ]);
        $parser->addOption('currentorderfield', [
            'short' => 'c',
            'help' => 'Current order field',
        ]);
        $parser->addOption('currentfielddirection', [
            'short' => 'd',
            'help' => 'Current order field direction',
        ]);

        return $parser;
    }

    /**
     * Main method for shell execution
     *
     * @param string $module Module
     * @return bool|int|void
     */
    public function main(string $module = '')
    {
        $this->setModule();
        $this->setField();
        $this->setCurrentOrderField();
        $this->setCurrentOrderFieldDirection();

        $this->updateFileStorage($this->module, $this->field, $this->currentOrderField, $this->currentOrderFieldDirection);
    }

    /**
     * Update file storage records
     * @param string $module Module name
     * @param string $field Field
     * @param string $currentOrderField Current field
     * @param string $currentOrderFieldDirection Current direction
     * @return void
     */
    public function updateFileStorage(string $module, string $field, string $currentOrderField = '', string $currentOrderFieldDirection = ''): void
    {
        $config = ModuleRegistry::getModule($module)->getConfig();
        $moduleFields = ModuleRegistry::getModule($module)->getFields();

        $table = TableRegistry::getTableLocator()->get($module);

        $fileStorageTable = TableRegistry::getTableLocator()->get('FileStorage');
        //dd($fileStorageTable);

        $moduleRecords = $table->find('all');
        $fileUpload = new FileUpload($table);

        foreach ($moduleRecords as $key => $record) {
            $files = $fileUpload->getFiles($field, $record->get('id'), [$currentOrderField => $currentOrderFieldDirection])->toArray();

            if (!($files)) {
                continue;
            }

            /**
             * @var mixed[]
             */
            $filesIds = Hash::extract($files, '{n}.id');

            self::updateFilesOrder($filesIds, self::NEW_ORDER_FIELD, $fileStorageTable);
        }
    }

    /**
     * Array of file Ids
     * @param  mixed[] $filesIds File Ids to update
     * @param  string  $orderField Order field to update
     * @param  \Cake\ORM\Table $fileStorageTable File Storage table
     * @return void
     */
    public function updateFilesOrder(array $filesIds, string $orderField, \Cake\ORM\Table $fileStorageTable): void
    {
        $data = [];
        foreach ($filesIds as $key => $id) {
            $entity = $fileStorageTable->get($id);
            $entity->set($orderField, $key);
            $fileStorageTable->saveOrFail($entity);
        }
    }

    /**
     * @param string $module Module Name
     * @return void|null|int
     */
    public function setModule(string $module = '')
    {
        if (isset($this->params['module'])) {
            $this->module = $this->params['module'];
        } else {
            $this->module = $module;
        }
    }

    /**
     * @return string
     */
    private function getModule(): string
    {
        return $this->module;
    }

    /**
     * @param string $field Field Name
     * @return void|null|int
     */
    public function setField(string $field = '')
    {
        if (isset($this->params['field'])) {
            $this->field = $this->params['field'];
        } else {
            $this->field = $field;
        }
    }

    /**
     * @return string
     */
    private function getField(): string
    {
        return $this->field;
    }

    /**
     * @param string $currentorderfield Field Name
     * @return void|null|int
     */
    public function setCurrentOrderField(string $currentorderfield = '')
    {
        if (isset($this->params['currentorderfield'])) {
            $this->currentOrderField = $this->params['currentorderfield'];
        } else {
            $this->currentOrderField = $currentorderfield;
        }
    }

    /**
     * @return string
     */
    private function getCurrentOrderField(): string
    {
        return $this->currentOrderField;
    }

    /**
     * @param string $currentfielddirection Field Name
     * @return void|null|int
     */
    public function setCurrentOrderFieldDirection(string $currentfielddirection = '')
    {
        if (isset($this->params['currentfielddirection'])) {
            $this->currentOrderFieldDirection = $this->params['currentfielddirection'];
        } else {
            $this->currentOrderFieldDirection = $currentfielddirection;
        }
    }

    /**
     * @return string
     */
    private function getCurrentOrderFieldDirection(): string
    {
        return $this->currentOrderFieldDirection;
    }
}
