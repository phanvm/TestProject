<div class="title-nav">
	<span>Nạp thẻ</span>
	<i class="bottom-title"></i>
</div>
<style>
div.area-recharge{
	width: 100%;
	float: left;
	padding: 10px;
}
div.title-recharge{
	float: left;
	width: 100%;
	text-align: left;
	font-weight: bold;
	color: #78b43d;
	margin: 10px 0;
}
img.help-card{
	width: 100%;
}
div.option-card{
	width: 100%;
	float: left;
	margin: 10px 0;
}
div.option-card ul{
	list-style: none;
	width: 100%;
	float: left;
}
div.option-card ul li{
	float: left;
	width: 20%;
	text-align:center;
	padding: 10px;
}
div.option-card ul li img{
	float: left;
	width: 100%;
}
.req{
	color: red;
}
</style>
<form action="<?php echo __('/nap-the');?>" method="post" name="frm_card" id="frm_card">
<div class="area-recharge">
	<div class="title-recharge"><?php echo __('1. Hướng dẫn nạp thẻ')?></div>
	<span>
		Sau khi là thành viên Bạn sẽ nhận được dự đoán xổ số miền bắc thống kê và phân tích chính xác về kết quả xổ số miền Bắc hàng ngày của các chuyên gia lovip88.com . Rất mong các dự đoán kết quả này sẽ giúp các bạn tham khảo một cách tốt nhất để đưa ra được dự đoán của riêng mình một cách hiệu quả nhất. 
	</span>
	<img class="help-card" src="/img/help_card.jpg">
	<div class="title-recharge"><?php echo __('1. Nạp tiền vào tài khoản')?></div>
	<div class="option-card">
		<ul>
			<li>
				<img alt="" src="/img/vinaphone.jpg" />
				<input type="radio" name="card_type" value="vinaphone" checked="checked" />
				<span>Vinaphone</span>
			</li>
			<li>
				<img alt="" src="/img/viettel.jpg" />
				<input type="radio" name="card_type" value="viettel" />
				<span>Viettel</span>
			</li>
			<li>
				<img alt="" src="/img/mobifone.jpg" />
				<input type="radio" name="card_type" value="mobifone" />
				<span>MobiFone</span>
			</li>
			<li>
				<img alt="" src="/img/vtc.jpg" />
				<input type="radio" name="card_type" value="vcoin" />
				<span>Vcoin</span>
			</li>
			<li>
				<img alt="" src="/img/gate.jpg" />
				<input type="radio" name="card_type" value="gate" />
				<span>GATE</span>
			</li>
		</ul>
	</div>
	<div class="option-card">
    		<div class="small-12 columns">
    			<?php echo $this->Session->flash();?>
    			<div class="row">
			        <div class="small-3 columns">
			          <label for="right-label" class="right inline">Số serial<span class="req">*</span></label>
			        </div>
			        <div class="small-9 columns pd-right">
			          <input type="text" name="serial_card" id="right-label">
			        </div>
      			</div>
      			<div class="row">
			        <div class="small-3 columns">
			          <label for="right-label" class="right inline">Mã số thẻ<span class="req">*</span></label>
			        </div>
			        <div class="small-9 columns pd-right">
			          <input type="text" name="card_code" id="right-label">
			        </div>
      			</div>
      			<div class="row">
			        <div class="small-3 columns">
			        </div>
			        <div class="small-9 columns pd-right">
			         	<input type="submit" name="submit" value="Nạp Thẻ" class="button" />
			        </div>
		      </div>
			</div>
	</div>
</div>
</form>