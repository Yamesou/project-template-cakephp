<?php
use Cake\Utility\Hash;
use Cake\Utility\Inflector;
use Qobo\Utils\Module\ModuleRegistry;

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

        $label .= $this->Module->associationLabel($tableName, $association->getAlias());

        if (in_array($label, $setLabels)) {
            $label .= $this->Module->fieldLabel($tableName, $association->getForeignKey());
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
