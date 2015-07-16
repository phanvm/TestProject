<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 style="text-transform: uppercase;">
        <?php echo $this->request->params['controller'];?>
        <small style="text-transform: uppercase;"><?php echo $this->request->params['action'];?></small>
    </h1>
    <ol class="breadcrumb" style="text-transform: uppercase;">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $this->request->params['controller'];?></li>
    </ol>
</section>
