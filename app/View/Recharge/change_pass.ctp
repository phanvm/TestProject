<div class="title-nav">
	<span>Đổi mật khẩu</span>
	<i class="bottom-title"></i>
</div>
<?php echo $this->Session->flash(); ?>
<form action="<?php echo __('/doi-mat-khau');?>" method="post" name="frm_register" id="frm_register">
    <div class="small-12 columns">
      <div class="row">
        <div class="small-3 columns">
          <label for="right-label" class="right inline">Mật Khẩu Cũ<span class="req">*</span></label>
        </div>
        <div class="small-9 columns pd-right">
          <input type="password" name="pass_old" id="right-label">
        </div>
      </div>
       <div class="row">
        <div class="small-3 columns">
          <label for="right-label" class="right inline">Mật khẩu Mới<span class="req">*</span></label>
        </div>
        <div class="small-9 columns pd-right">
          <input type="password" name="password" id="right-label" >
        </div>
      </div>
       <div class="row">
        <div class="small-3 columns">
          <label for="right-label" class="right inline">Xác nhận mật khẩu<span class="req">*</span></label>
        </div>
        <div class="small-9 columns pd-right">
          <input type="password" name="verify_password" id="right-label" >
        </div>
      </div>
      <div class="row">
        <div class="small-3 columns">
        </div>
        <div class="small-9 columns pd-right">
         	<input type="submit" name="submit" value="Đăng Ký" class="button" />
         	<a class="button btn-reset" href="">Làm Lại</a>
        </div>
      </div>
    </div>
</form>
<script>
$(document).ready(function(){
	$(".btn-send").on("click",function(){
		$("#frm_register").submit();
	});
});
</script>