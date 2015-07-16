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
		<?php echo $this->Session->flash();?>
		<!-- left column -->
		<div class="col-md-6">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title" style="text-transform: uppercase;">Add new Employee</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" method="post" action="/add-new-employee" name="frmEmployee"  enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Employee Name</label> 
							<input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Enter Employee">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Authorization</label> 
							<select name="authorization" class="form-control" style="width: 40%">
								<option value="2">Employee</option>
								<option value="1">HR Employee</option>
								<option value="0">HR Manager</option>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Date of Brith</label> 
							<input type="date" class="form-control" name="brithday" id="exampleInputPassword1" >
						</div>
						<div class="form-group" style="position: relative;">
							<label for="exampleInputFile">Photo</label> 
							<input type="file" name="photo" id="inputFilePhoto">
							<p class="help-block">Example block-level help text here.</p>
							<img alt="" src="/img/avatar5.png" id="prevPhoto" />
						</div>
						<div class="form-group">
							<label for="sex">Sex</label>
							<div id="sex">
								<span><input type="radio" class="sex" name="sex" value="0">Nam</span>
								<span><input type="radio" class="sex" name="sex" value="1">Nữ</span>
							</div> 
						</div>
						<div class="form-group" style="margin-top: 55px;">
							<label for="employee_address">Address</label> 
							<input type="text" name="address" id="employee_address" class="form-control" placeholder="Please Enter Address">
						</div>
						<div class="form-group">
							<label for="employee_address">Email</label> 
							<input type="text" name="email" id="employee_email" class="form-control" placeholder="Please Enter Email">
						</div>
						<div class="form-group">
							<label for="employee_address">Telephone</label> 
							<input type="text" name="telephone" id="employee_telephone" class="form-control" placeholder="Please Enter Telephone">
						</div>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
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