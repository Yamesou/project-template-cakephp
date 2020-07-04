<?php
use Cake\Core\Configure;
?>
<?php $this->Html->scriptStart(array('block' => 'scriptBottom', 'inline' => false)); ?>

$("#list-themes div[class^='col-']").on("click", function(){
    let color = $(this).find('p').text().toLowerCase().replace(" ", "-")
    $('input[name="Settings[Theme][skin]"]').attr('value', color)
    $("#list-themes div[class^='col-']").addClass('full-opacity-hover')
    $("#list-themes p").css('font-weight', 'normal');
    $(this).removeClass('full-opacity-hover')
    $(this).find('p').css('font-weight', 'bold');
})

<?php $this->Html->scriptEnd(); ?>
<section class="content-header">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h4><?= __('Settings &raquo; Themes'); ?></h4>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <?= $this->Form->create($settings); ?>
            <input name="Settings[Theme][skin]" type="hidden" value="<?= Configure::read("Theme.skin") ?>">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('Select AdminLTE Skin colors') ?></h3>
                </div>
                <div class="box-body" id="list-themes">
                    <div class="row">
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 13px; background: #367fa9"></span><span
                                    class="bg-light-blue"
                                    style="display:block; width: 80%; float: left; height: 13px;"></span></div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #222d32"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Blue</p>
                        </div>
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 13px; background: #fefefe"></span><span
                                    style="display:block; width: 80%; float: left; height: 13px; background: #fefefe"></span>
                            </div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #222"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Black</p>
                        </div>
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span style="display:block; width: 20%; float: left; height: 13px;"
                                    class="bg-purple-active"></span><span class="bg-purple"
                                    style="display:block; width: 80%; float: left; height: 13px;"></span></div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #222d32"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Purple</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span style="display:block; width: 20%; float: left; height: 13px;"
                                    class="bg-green-active"></span><span class="bg-green"
                                    style="display:block; width: 80%; float: left; height: 13px;"></span></div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #222d32"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Green</p>
                        </div>
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span style="display:block; width: 20%; float: left; height: 13px;"
                                    class="bg-red-active"></span><span class="bg-red"
                                    style="display:block; width: 80%; float: left; height: 13px;"></span></div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #222d32"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Red</p>
                        </div>
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span style="display:block; width: 20%; float: left; height: 13px;"
                                    class="bg-yellow-active"></span><span class="bg-yellow"
                                    style="display:block; width: 80%; float: left; height: 13px;"></span></div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #222d32"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Yellow</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 13px; background: #367fa9"></span><span
                                    class="bg-light-blue"
                                    style="display:block; width: 80%; float: left; height: 13px;"></span></div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #f9fafc"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Blue Light</p>
                        </div>
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 13px; background: #fefefe"></span><span
                                    style="display:block; width: 80%; float: left; height: 13px; background: #fefefe"></span>
                            </div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #f9fafc"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Black Light</p>
                        </div>
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span style="display:block; width: 20%; float: left; height: 13px;"
                                    class="bg-purple-active"></span><span class="bg-purple"
                                    style="display:block; width: 80%; float: left; height: 13px;"></span></div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #f9fafc"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Purple Light</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span style="display:block; width: 20%; float: left; height: 13px;"
                                    class="bg-green-active"></span><span class="bg-green"
                                    style="display:block; width: 80%; float: left; height: 13px;"></span></div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #f9fafc"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Green Light</p>
                        </div>
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span style="display:block; width: 20%; float: left; height: 13px;"
                                    class="bg-red-active"></span><span class="bg-red"
                                    style="display:block; width: 80%; float: left; height: 13px;"></span></div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #f9fafc"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Red Light</p>
                        </div>
                        <div class="col-xs-12 col-md-4 full-opacity-hover">
                            <div><span style="display:block; width: 20%; float: left; height: 13px;"
                                    class="bg-yellow-active"></span><span class="bg-yellow"
                                    style="display:block; width: 80%; float: left; height: 13px;"></span></div>
                            <div><span
                                    style="display:block; width: 20%; float: left; height: 40px; background: #f9fafc"></span><span
                                    style="display:block; width: 80%; float: left; height: 40px; background: #f4f5f7"></span>
                            </div>
                            <p class="text-center" style="padding: 10px">Yellow Light</p>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary','value' => 'submit']);
                echo $this->Form->end();
            ?>
        </div>
    </div>
</section>