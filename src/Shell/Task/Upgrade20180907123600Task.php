<?php

namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use CsvMigrations\FieldHandlers\CsvField;
use Qobo\Utils\ModuleConfig\ConfigType;
use Qobo\Utils\ModuleConfig\ModuleConfig;
use Qobo\Utils\Utility;

/**
 *  This class is responsible for adding database lists defined in modules configuration to the database.
 */
class Upgrade20180907123600Task extends Shell
{
    /**
     * Configure option parser
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->setDescription('Create Database List records from CSV migrations');

        return $parser;
    }

    /**
     * main() method.
     *
     * @return int|bool|null
     */
    public function main()
    {
        $modules = Utility::findDirs(Configure::read('CsvMigrations.modules.path'));
        if (empty($modules)) {
            $this->err('No CSV modules found.');

            return false;
        }

        $lists = $this->getDatabaseLists($modules);
        if (empty($lists)) {
            $this->info('No database list fields found in the application.');

            return false;
        }

        $this->createDatabaseLists($lists);

        $this->success(sprintf('%s completed.', $this->getOptionParser()->getDescription()));

        return true;
    }

    /**
     * Retrieves database list names for specified modules.
     *
     * @param string[] $modules Module names
     * @return mixed[]
     */
    protected function getDatabaseLists(array $modules): array
    {
        $result = [];
        foreach ($modules as $module) {
            $result[$module] = $this->getDatabaseListsByModule($module);
        }

        return array_filter($result);
    }

    /**
     * Get an array of database lists from migrations config.
     *
     * @param string $module Module name
     * @return mixed[]
     */
    protected function getDatabaseListsByModule(string $module): array
    {
        $config = (new ModuleConfig(ConfigType::MIGRATION(), $module))->parseToArray();

        if (empty($config)) {
            return [];
        }

        $result = [];
        foreach ($config as $conf) {
            $field = new CsvField($conf);
            if ('dblist' === $field->getType()) {
                $result[] = $field->getLimit();
            }
        }

        return $result;
    }

    /**
     * Creates database lists records for all relevant fields found in the application.
     *
     * @param mixed[] $lists Database lists from all modules
     * @return void
     */
    protected function createDatabaseLists(array $lists): void
    {
        foreach ($lists as $moduleLists) {
            $this->createDatabaseListsByModule($moduleLists);
        }
    }

    /**
     * Creates database lists for a specific module.
     *
     * @param string[] $lists Module relevant database lists
     * @return void
     */
    protected function createDatabaseListsByModule(array $lists): void
    {
        $table = TableRegistry::getTableLocator()->get('CsvMigrations.Dblists');

        foreach ($lists as $list) {
            $count = $table->find('all')
                ->where(['name' => $list])
                ->count();

            if (0 < $count) {
                $this->info(sprintf('Database list record "%s" already exists.', $list));
                continue;
            }

            $entity = $table->newEntity(['name' => $list]);

            if ($table->save($entity)) {
                $this->success(sprintf('Added "%s" to database lists table.', $list));
            }
        }
    }
}
