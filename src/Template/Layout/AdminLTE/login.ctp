<?php
use Cake\Core\Configure;
use Cake\Filesystem\Folder;

//$this->Html->css('login', ['block' => 'css']);

$skinUrl = Configure::read('Theme.skinUrl');
$skinName = Configure::read('Theme.skin');
$title = Configure::read('Theme.title.' . $this->name);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <?php echo $this->Html->css('AdminLTE./bower_components/bootstrap/dist/css/bootstrap.min'); ?>
        <?php echo $this->Html->css('/plugins/font-awesome/css/font-awesome.min'); ?>

        <?php echo $this->Html->css('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'); ?>
        <?php echo $this->Html->css('AdminLTE.AdminLTE.min'); ?>
        <?php echo $this->Html->css($skinUrl); ?>
        <?php echo $this->Html->css('login.min'); ?>
        <?php echo $this->fetch('css'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-<?= $skinName ?> login-page">
        <?= $this->Html->backgroundLogoImage() ?>
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo $this->Url->build('/'); ?>"><?= $this->element('logo') ?></a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p> <?php echo $this->Flash->render(); ?> </p>
                <p> <?php echo $this->Flash->render('auth'); ?> </p>

                <?php echo $this->fetch('content'); ?>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <?php echo $this->Html->script('AdminLTE./bower_components/jquery/dist/jquery.min'); ?>
        <?php echo $this->Html->script('AdminLTE./bower_components/bootstrap/dist/js/bootstrap.min'); ?>
        <!-- AdminLTE App -->
        <?php echo $this->Html->script('AdminLTE./js/adminlte.min'); ?>

        <?php echo $this->fetch('script'); ?>
        <?php echo $this->fetch('scriptBottom'); ?>
    </body>
</html>
