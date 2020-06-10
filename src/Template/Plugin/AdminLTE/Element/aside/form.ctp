<?php
use Cake\Utility\Hash;
use Qobo\Utils\Module\Exception\MissingModuleException;
use Qobo\Utils\Module\ModuleRegistry;
use RolesCapabilities\Access\AccessFactory;

$config = [];
try {
    $config = ModuleRegistry::getModule($this->name)->getConfig();
} catch (MissingModuleException $e) {
    // @ignoreException
}

if (! Hash::get($config, 'table.searchable')) {
    return;
}

$url = ['plugin' => $this->plugin, 'controller' => $this->name, 'action' => 'search'];
if (! (new AccessFactory())->hasAccess($url, $user)) {
    return;
}

echo $this->element('search-form', ['name' => Hash::get($config, 'table.alias', $this->name)]);
