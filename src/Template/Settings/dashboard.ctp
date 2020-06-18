<?php

use Cake\ORM\TableRegistry;
use CsvMigrations\FieldHandlers\FieldHandlerFactory;
use RolesCapabilities\Access\AccessFactory;

// get all user dashboards
$tableDashboards = TableRegistry::get('Search.Dashboards');
$dashboards = $tableDashboards->find('list')->toArray();

$fhf = new FieldHandlerFactory($this);

$currentDashboardOrder = $configure['Menu.dashboard_menu_order_value'];
$currentDashboardOrderJson = json_decode($currentDashboardOrder, true) ?? [];

if ($dashboards) {
    foreach($currentDashboardOrderJson as $id => $order) {
        if (empty($dashboards[$id])) {
            continue;
        }

        //move element to buttom
        $value = $dashboards[$id];
        unset($dashboards[$id]);
        $dashboards[$id] = $value;
    }
}

echo $this->Html->script('AdminLTE./bower_components/jquery-ui/jquery-ui.min', ['block' => 'script']);

?>

<?php $this->Html->scriptStart(['block' => 'scriptBottom']); ?>
    (function ($) {

        $("ul.dashboard-menu-items").sortable({
            containment: 'parent',
            update: function (event, ui) {
                var items = {}
                $("li.dashboard-menu-item").each(function(){
                    items [$(this).attr('id')] = $(this).index();
                })

                $('#settings-dashboard_menu_order_value').val(JSON.stringify(items));
            }
        });

    })(jQuery);
<?= $this->Html->scriptEnd() ?>

<section class="content-header">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h4><?= __('Settings &raquo; Dashboards'); ?></h4>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="pull-right">
                <?php
                $factory = new AccessFactory();
                $url = [ 'controller' => $this->request->controller, 'action' => 'add'];
                if ($factory->hasAccess($url, $user)):
                ?>
                <a href="/search/dashboards/add" title="Add" target="_self" class="btn btn-default"><i class="menu-icon fa fa-plus"></i> Add</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<?= $this->Form->create($settings); ?>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= $this->Form->label(__('Reorder Dashboards')); ?></h3>
                </div>
                <div class="box-body">
                    <ul class="dashboard-menu-items" style="display: block; list-style: none;">
                    <?php foreach($dashboards as $dashboatdId => $dashboard) : ?>
                        <li style="height:50px;" class="dashboard-menu-item" id="<?=$dashboatdId?>"><a type="button" title="<?=$dashboard?>" class="btn btn-default btn-block" style="text-align: left;"><i class="fa fa-tachometer"></i> <?=$dashboard?></a></li>
                    <?php endforeach; ?>
                </div>
            </div>

			<?php
                echo $this->Form->hidden('Settings.Menu.dashboard_menu_order_value', ['id' => 'settings-dashboard_menu_order_value', 'value' => $currentDashboardOrder]);
				echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary','value' => 'submit']);
				echo $this->Form->end();
			?>
		</div>
	</div>
</section>
