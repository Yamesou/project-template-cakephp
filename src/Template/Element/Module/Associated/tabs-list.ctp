<?php
use Cake\Utility\Hash;
use Cake\Utility\Inflector;
use Qobo\Utils\Module\ModuleRegistry;

$labels = Hash::get(ModuleRegistry::getModule($this->name)->getConfig(), 'associationLabels', []);
$setLabels = [];
?>
<ul id="relatedTabs" class="nav nav-tabs responsive-tabs" role="tablist">
    <?php $active = 'active'; ?>
    <?php foreach ($associations as $association) : ?>
        <?php
        $containerId = Inflector::underscore($association->getAlias());

        list(, $tableName) = pluginSplit($association->getClassName());
        $config = ModuleRegistry::getModule($tableName)->getConfig();

        $label = '<span class="fa fa-' . $config['table']['icon'] . '"></span> ';

        if (array_key_exists($association->getAlias(), $labels)) {
            $label .= __($labels[$association->getAlias()]);
        } else {
            $label .= isset($config['table']['alias']) ?
                __($config['table']['alias']) :
                __(Inflector::humanize(Inflector::delimit($tableName)));
        }

        if (in_array($label, $setLabels)) {
            $configFields = ModuleRegistry::getModule($tableName)->getFields();

            if (array_key_exists($association->getForeignKey(),$configFields) && array_key_exists('label',$configFields[$association->getForeignKey()]) ) {
                $label .= ' (' . $configFields[$association->getForeignKey()]['label'] . ')';
            }else{
                $label .= ' (' . Inflector::humanize(Inflector::delimit($association->getForeignKey())) . ')';
            }
        }

        $setLabels[] = $label;
        ?>
        <li role="presentation" class="<?= $active ?>">
            <?= $this->Html->link($label, '#' . $containerId, [
                'role' => 'tab', 'data-toggle' => 'tab', 'escape' => false, 'class' => $containerId
            ]);?>
        </li>
        <?php $active = ''; ?>
    <?php endforeach; ?>
</ul>
