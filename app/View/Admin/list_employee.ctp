<?php echo $this->Html->script(array('jquery.colorbox-min.js'),array('inline'=>false)); ?>
<style>
i.ic-delete{
	background: url("img/ic-delete.png");
	background-size: 24px;
	width: 24px;
	height: 24px;
	display: block;
	float: left;
	margin: 5px;
	cursor: pointer;
}
i.edit_icon{
	background: url("img/edit_icon.png");
	background-size: 24px;
	width: 24px;
	height: 24px;
	display: block;
	float: left;
	margin: 5px;
	cursor: pointer;
}
</style>

<div class="col-xs-12">
	<?php if((int)$auth['change_pass_flag'] == 0):?>
		<div class="callout callout-success">
			<p>Please change the default password.</p>
			<p>Default password: 123456</p>
		</div>
	<?php endif;?>
	<?php echo $this->Session->flash();?>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">List Employee</h3>
			<div class="box-tools">
				<div class="input-group">
					<input type="text" name="table_search"
						class="form-control input-sm pull-right" style="width: 150px;"
						placeholder="Search">
					<div class="input-group-btn">
						<button class="btn btn-sm btn-default">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover">
				<tbody>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Username</th>
						<th>Day of Birth</th>
						<th>Telephone</th>
						<th>Email</th>
						<th>Authen</th>
						<th>Created</th>
						<?php if($auth['group_id'] == 0 || $auth['group_id'] == 1):?>
							<th>Controller</th>
						<?php endif;?>
					</tr>
					<?php if(!empty($list))foreach ($list as $item):?>
						<tr>
							<td><a href="<?php echo "/view-employee?emid=".$item['User']['id'];?>" class="employee_popup" ><?php echo $item['User']['id'];?></a></td>
							<td><a href="<?php echo "/view-employee?emid=".$item['User']['id'];?>"><?php echo $item['User']['username'];?><a href="#"></td>
							<td><?php echo $item['User']['username'];?></td>
							<td><?php echo $item['User']['date_of_brith'];?></td>
							<td><?php echo $item['User']['telephone'];?></td>
							<td><?php echo $item['User']['email'];?></td>
							<td><?php echo ($item['User']['group_id'] == 0 ) ? "HR Manager" : (($item['User']['group_id'] == 1) ? "HR Employee" : "Employee");?></td>
							<td><?php echo date('Y-m-d H:i:s',$item['User']['created']);?></td>
							<?php if($auth['group_id'] == 0 || $auth['group_id'] == 1):?>
									<td style="position: relative;">
										<?php if($auth['id'] != $item['User']['id']):?>
											<i class="ic-delete" onclick="deleteEmployee('<?php echo $item['User']['id'];?>','list')"></i>
										<?php endif;?>
										<i class="edit_icon" onclick="redirect_js('/employee-edit?emid=<?php echo $item['User']['id'];?>')"></i>
									</td>
							<?php endif;?>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".employee_popup").on("click",function(){
		});
	});
	function openPoup( link ){
		
	}
</script>