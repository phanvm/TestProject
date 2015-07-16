<style>
p.form-control-label {
	margin-left: 0;
	padding-left: 0;
	border: none;
}

.employee-info p {
	color: #333 !important;
	font-weight: bold !important;
}

.employee-info label {
	color: #888 !important;
}

#prevPhoto {
	width: 160px;
	height: 200px;
	right: 0px;
	top: 0;
	bottom: 0;
}

i.ic-delete {
	background: url("img/ic-delete.png");
	background-size: 24px;
	width: 24px;
	height: 24px;
	display: block;
	float: left;
	margin: 5px;
	cursor: pointer;
}

i.edit_icon {
	background: url("img/edit_icon.png");
	background-size: 24px;
	width: 24px;
	height: 24px;
	display: block;
	float: left;
	margin: 5px;
	cursor: pointer;
}

.controll_info {
	float: right;
}
</style>
<section class="content employee-info">
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title" style="text-transform: uppercase;"><?php echo $employeeInfo['User']['username'];?></h3>
					<?php if($auth['group_id'] == 0 ||  $auth['group_id'] == 1):?>
					<div class="controll_info">
						<?php if($auth['id'] != $employeeInfo['User']['id']):?>
						<i class="ic-delete"
							onclick="deleteEmployee('<?php echo $employeeInfo['User']['id'];?>','info')"></i>
						<?php endif;?>
						<i class="edit_icon"
							onclick="redirect_js('/employee-edit?emid=<?php echo $employeeInfo['User']['id'];?>')"></i>
					</div>
					<?php endif;?>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" method="post" action="/add-new-employee"
					name="frmEmployee" enctype="multipart/form-data">
					<div class="box-body">

						<div class="form-group" style="width: 50%; float: left;">
							<label for="exampleInputEmail1">Employee Name</label>
							<p class="form-control form-control-label"
								id="exampleInputEmail1"><?php echo $employeeInfo['User']['username'];?></p>
						</div>
						<div class="form-group" style="width: 50%; float: left;">
							<img alt=""
								src="<?php echo AppConst::UPLOAD_DIR_USER_PHOTO.$employeeInfo['User']['photo'];?>"
								id="prevPhoto" />
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Authorization</label>
							<p class="form-control form-control-label"
								id="exampleInputEmail1"><?php echo ($employeeInfo['User']['group_id'] == 0 ) ? "HR Manager" : (($employeeInfo['User']['group_id'] == 1) ? "HR Employee" : "Employee");?> </p>
						</div>
						<div class="form-group" style="width: 50%; float: left;">
							<label for="exampleInputPassword1">Brith Day</label>
							<p class="form-control form-control-label"
								id="exampleInputEmail1"><?php echo $employeeInfo['User']['date_of_brith'];?></p>
						</div>
						<div class="form-group" style="width: 50%; float: left;">
							<label for="sex">Sex</label>
							<p class="form-control form-control-label"
								id="exampleInputEmail1"><?php echo ($employeeInfo['User']['sex'] == 0) ? "Nam"  : "Nữ";?></p>
						</div>
						<div class="form-group" style="width: 50%; float: left;">
							<label for="employee_address">Email</label>
							<p class="form-control form-control-label"
								id="exampleInputEmail1"><?php echo $employeeInfo['User']['email'];?></p>
						</div>
						<div class="form-group" style="width: 50%; float: left;">
							<label for="employee_address">Telephone</label>
							<p class="form-control form-control-label"
								id="exampleInputEmail1"><?php echo $employeeInfo['User']['telephone'];?></p>
						</div>
						<div class="form-group" style="margin-top: 55px;">
							<label for="employee_address">Address</label>
							<p class="form-control form-control-label"
								id="exampleInputEmail1"><?php echo $employeeInfo['User']['address'];?></p>
						</div>
					</div>
					<!-- /.box-body -->
				</form>
			</div>
			<!-- /.box -->
		</div>
		<!--/.col (right) -->
	</div>
	<!-- /.row -->
</section>