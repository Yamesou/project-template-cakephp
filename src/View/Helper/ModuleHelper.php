<?php
namespace App\View\Helper;

use App\View\Helper\Exception\InvalidModuleAssociationException;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;
use Cake\View\Helper;
use Qobo\Utils\Module\Exception\MissingModuleException;
use Qobo\Utils\Module\ModuleRegistry;
use Webmozart\Assert\Assert;

/**
 * Module helper
 */
class ModuleHelper extends Helper
{
    /**
     * @var \Qobo\Utils\Module\ModuleRegistry
     */
    protected $registry;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * {@inheritDoc}
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $registry = $config['registry'] ?? ModuleRegistry::instance();
        Assert::object($registry, (string)__('Module registry must be an object.'));
        Assert::isInstanceOf($registry, ModuleRegistry::class, (string)__('Invalid module registry class: {0}', get_class($registry)));
        $this->registry = $registry;
    }

    /**
     * Returns the module's table alias
     *
     * @param string $moduleName Module name
     * @param string $default Default value to return if no table alias is present
     * @return string
     */
    public function getTableAlias(string $moduleName, string $default = ''): string
    {
        $formatter = function ($moduleName) {
            return Inflector::humanize(Inflector::underscore($moduleName));
        };

        try {
            $module = $this->registry->getModule($moduleName);
            if (empty($default)) {
                $default = $formatter($moduleName);
            }

            return Hash::get($module->getConfig(), 'table.alias', $default);
        } catch (MissingModuleException $e) {
            // @ignoreException
            if (!empty($default)) {
                return $default;
            }

            return $formatter($moduleName);
        }
    }

    /**
     * Returns the field label.
     *
     * @param string $moduleName Module name
     * @param string $fieldName Field name
     * @param string $default Default value to return if no field label is present
     * @return string
     */
    public function fieldLabel(string $moduleName, string $fieldName, string $default = ''): string
    {
        $formatter = function ($fieldName) {
            return Inflector::humanize(Inflector::underscore($fieldName));
        };

        try {
            $module = $this->registry->getModule($moduleName);
            $path = sprintf('%s.label', $fieldName);
            if (empty($default)) {
                $default = $formatter($fieldName);
            }

            return Hash::get($module->getFields(), $path, $default);
        } catch (MissingModuleException $e) {
            // @ignoreException
            if (!empty($default)) {
                return $default;
            }

            return $formatter($fieldName);
        }
    }

    /**
     * Returns the association label.
     *
     * @param string $moduleName Module name
     * @param string $associationName Association name
     * @param string $default Default value to return if no association name is present
     * @return string
     */
    public function associationLabel(string $moduleName, string $associationName, string $default = ''): string
    {
        $formatter = function ($associationName) {
            return Inflector::humanize(Inflector::delimit($associationName));
        };

        try {
            $module = $this->registry->getModule($moduleName);
            $path = sprintf('associationLabels.%s', $associationName);
            if (empty($default)) {
                $default = $formatter($associationName);
            }
            $table = TableRegistry::getTableLocator()->get($moduleName);

            return Hash::get($module->getConfig(), $path, $default);
        } catch (MissingModuleException $e) {
            // @ignoreException
            if (!empty($default)) {
                return $default;
            }

            $table = TableRegistry::getTableLocator()->get($moduleName);
            if (!$table->hasAssociation($associationName)) {
                throw new InvalidModuleAssociationException((string)__(
                    'The module {0} doesn\'t have an association called {1}',
                    $moduleName,
                    $associationName
                ), $e->getCode(), $e);
            }
            $association = $table->getAssociation($associationName);

            return $formatter($association->getName());
        }
    }
}
