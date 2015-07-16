<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
        	<?php echo __('Demo HelloByte')?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array('bootstrap.min.css', 'font-awesome.min.css', 'ionicons.min.css','daterangepicker/daterangepicker-bs3.css','colorpicker/bootstrap-colorpicker.min.css','timepicker/bootstrap-timepicker.min.css', 'AdminLTE.css','colorbox.css'));
        echo $this->Html->script(array('jquery.min-2.0.2.js','jquery.colorbox.js','app.js'));
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body class="skin-black">
        <?php echo $this->Element('header'); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php echo $this->Element('menu_left'); ?>
            <aside class="right-side">     
                <?php echo $this->Element('left_side'); ?>
                <section class="content">
                <div class="col-xs-14">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
                </div>
                </section><!-- /.content -->
            </aside>
        </div>
        <?php // echo $this->element('sql_dump'); ?>
       
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
         <!-- InputMask -->
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
    </body>
</html>
