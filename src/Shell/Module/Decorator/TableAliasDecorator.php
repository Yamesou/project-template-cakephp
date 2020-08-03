<?php
namespace App\Shell\Module\Decorator;

use Cake\Utility\Inflector;

class TableAliasDecorator
{
    /**
     * Runs the decorator
     *
     * @param string $moduleName Module name
     * @param mixed[] $data Incoming module data
     * @return mixed[]
     */
    public function __invoke(string $moduleName, array $data): array
    {
        if (empty($data['config']['table']['alias'])) {
            $data['config']['table']['alias'] = Inflector::humanize(Inflector::underscore($moduleName));
        }

        return $data;
    }
}
