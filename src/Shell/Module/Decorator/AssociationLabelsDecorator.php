<?php
namespace App\Shell\Module\Decorator;

use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

class AssociationLabelsDecorator
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
        $table = TableRegistry::getTableLocator()->get($moduleName);

        /** @var \Cake\ORM\Association */
        foreach ($table->associations()->getIterator() as $association) {
            $name = $association->getName();
            if (!empty($data['config']['associationLabels'][$name])) {
                continue;
            }
            $data['config']['associationLabels'][$name] = Inflector::humanize(Inflector::delimit($name));
        }

        return $data;
    }
}
