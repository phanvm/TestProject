<style>
#prevPhoto{
	width: 160px;
  	height: 200px;
  	position: absolute;
  	right: 0px;
  	top: 0;
  	bottom: 0;
}
</style>
<section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-md-6">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title" style="text-transform: uppercase;">Edit Employee</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" method="post" action="/employee-edit?emid=<?php echo $employeeInfo['User']['id']; ?>" name="frmEmployee"  enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Employee Name</label> 
							<input type="text" class="form-control" id="exampleInputEmail1" name="username" value="<?php echo $employeeInfo['User']['username'];?>" placeholder="Enter Employee">
						</div>
						<?php if($auth['group_id'] == 0):?>
							<div class="form-group">
								<label for="exampleInputEmail1">Authorization</label> 
								<select name="authorization" class="form-control" style="width: 40%">
									<option <?php if($employeeInfo['User']['group_id'] == 2){echo 'selected="selected"';}?>  value="2">Employee</option>
									<option <?php if($employeeInfo['User']['group_id'] == 1){echo 'selected="selected"';}?> value="1">HR Employee</option>
									<option <?php if($employeeInfo['User']['group_id'] == 0){echo 'selected="selected"';}?> value="0">HR Manager</option>
								</select>
							</div>
						<?php endif;?>
						<div class="form-group">
							<label for="exampleInputPassword1">Date of Brith</label> 
							<input type="date" class="form-control" name="brithday" value="<?php echo $employeeInfo['User']['date_of_brith'];?>" id="exampleInputPassword1" >
						</div>
						<div class="form-group" style="position: relative;">
							<label for="exampleInputFile">Photo</label> 
							<input type="file" name="photo" id="inputFilePhoto">
							<p class="help-block">Example block-level help text here.</p>
							<img alt="" src="<?php echo AppConst::UPLOAD_DIR_USER_PHOTO.$employeeInfo['User']['photo'];?>" id="prevPhoto" />
						</div>
						<div class="form-group">
							<label for="sex">Sex</label>
							<div id="sex">
								<span><input type="radio"  <?php if($employeeInfo['User']['sex'] == 0){echo 'checked="checked"';}?> class="sex" name="sex" value="0">Nam</span>
								<span><input type="radio" <?php if($employeeInfo['User']['sex'] == 1){echo 'checked="checked"';}?> class="sex" name="sex" value="1">Nữ</span>
							</div> 
						</div>
						<div class="form-group" style="margin-top: 55px;">
							<label for="employee_address">Address</label> 
							<input type="text" name="address" id="employee_address" value="<?php echo $employeeInfo['User']['address'];?>" class="form-control" placeholder="Please Enter Address">
						</div>
						<div class="form-group">
							<label for="employee_address">Email</label> 
							<input type="text" name="email" value="<?php echo $employeeInfo['User']['email'];?>" id="employee_email" class="form-control" placeholder="Please Enter Email">
						</div>
						<div class="form-group">
							<label for="employee_address">Telephone</label> 
							<input type="text" name="telephone" value="<?php echo $employeeInfo['User']['telephone'];?>" id="employee_telephone" class="form-control" placeholder="Please Enter Telephone">
						</div>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
			<!-- /.box -->
		</div>
		<!--/.col (right) -->
	</div>
	<!-- /.row -->
</section>
<script type="text/javascript">
$(document).ready(function(){
	$("#inputFilePhoto").change(function(){
		readURL(this);
	});
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#prevPhoto').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>