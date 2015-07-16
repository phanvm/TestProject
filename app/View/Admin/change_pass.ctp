<section class="content">
	<div class="row">
		<?php echo $this->Session->flash();?>
		<!-- left column -->
		<div class="col-md-6">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title" style="text-transform: uppercase;">Change Password</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" method="post" action="/changepass" name="frmEmployee"  enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Old Password</label> 
							<input type="password" class="form-control" id="exampleInputEmail1" name="old_pass" placeholder="Please Enter Old Password">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">New Password</label> 
							<input type="password" class="form-control" id="exampleInputEmail1" name="new_pass" placeholder="Please Enter New password">
						</div>
						<div class="form-group">
							<label for="employee_address">Confirm New Password</label> 
							<input type="password" name="confirm_new_pass" id="employee_email" class="form-control" placeholder="Please Enter New password">
						</div>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary">ChangePass</button>
					</div>
				</form>
			</div>
			<!-- /.box -->
		</div>
		<!--/.col (right) -->
	</div>
	<!-- /.row -->
</section>