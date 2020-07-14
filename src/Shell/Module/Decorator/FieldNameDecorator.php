<?php
namespace App\Shell\Module\Decorator;

use Cake\Utility\Inflector;

class FieldNameDecorator
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
        if (empty($data['fields'])) {
            return $data;
        }

        foreach ($data['fields'] as $fieldName => $fieldConfig) {
            if (!empty($fieldConfig['label'])) {
                continue;
            }

            $label = $this->createFieldLabel($fieldName);
            $data['fields'][$fieldName] = array_merge($data['fields'][$fieldName], ['label' => $label]);
        }

        return $data;
    }

    /**
     * Creates a field label using the field name.
     *
     * @see FormHelper::label()
     * @param string $name Field name
     * @return string
     */
    protected function createFieldLabel(string $name): string
    {
        if ('._ids' === substr($name, -5)) {
            $name = substr($name, 0, -5);
        }

        if (false !== strpos($name, '.')) {
            $fieldElements = explode('.', $name);
            $name = false !== end($fieldElements) ? end($fieldElements) : $name;
        }

        if (substr($name, -3) === '_id') {
            $name = substr($name, 0, -3);
        }
        $name = Inflector::humanize(Inflector::underscore($name));

        return $name;
    }
}
