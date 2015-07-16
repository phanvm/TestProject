<?php echo $this->Html->script(array('jquery.formatCurrency-1.4.0.min.js'),array('inline'=>false)); ?>
<?php echo $this->Session->flash(); ?>
<div class="text-per">
	<span>Tất cả những dịch vụ trên website Lovip88.com chỉ là những thống kê, phân tích bác nhớ hiện đại và tần suất ngày , tuần , tháng do phần mềm máy tính tạo ra . Tỉ lệ xuất hiện số còn tùy thuộc nhiều vào may mắn của bạn. Các bạn nên chú ý cân nhắc trước khi tham khảo . Chúng tôi không chịu bất cứ trách nhiệm gì về việc sử dụng số của các bạn .</span>
</div>

<div style="width: 100%; float: left;">
	<?php if( !empty($data_genres) ):?>
	<?php foreach ( $data_genres as $key => $item ):?>
	<?php if( !empty($item['parent']) && !empty($item['childrents']) && $item['parent']['id'] != AppConst::LOTO_FREE):?>
	<div style="width: 100%; float: left; font-weight: bold; margin: 10px 0;text-transform: uppercase;"><span><?php echo $item['parent']['name'];?></span></div>
	<?php foreach ( $item['childrents'] as $item_chils):?>
	<div style="width: 50%; float: left; min-height: 100px;">
		<span style="background: #d9edf7; width: 100%; text-align: center; padding: 10px; float: left"><?php echo $item_chils['name']?></span>
		<table style="width: 100%;">
			<tr>
				<td>Giá</td>
				<td><span id="point-<?php echo $item_chils['id']; ?>"><?php echo number_format($item_chils['point'],2);?></span><span> VND</span></td>
			</tr>
			<tr>
				<td>Giới thiệu</td>
				<td><?php echo $item_chils['name'];?></td>
			</tr>
			<?php if($item_chils['id'] == AppConst::VIP_SONG_THU_TRONG_NGAY):?>
			<tr>
				<td>Ngày</td>
				<td>
					<select class="choose-day" point="<?php echo $item_chils['point']; ?>" rels="point-<?php echo $item_chils['id']; ?>" name="num-day-<?php echo $item_chils['id']; ?>" id="num-day-<?php echo $item_chils['id']; ?>">
						<option value="1">1 Ngày</option>
						<option value="7">1 Tuần</option>
						<option value="30">1 Tháng</option>
					</select>
				</td>
			</tr>
			<?php else:?>
			<tr>
				<td>Ngày</td>
				<td>
					<select name="num-day-<?php echo $item_chils['id']; ?>" id="num-day-<?php echo $item_chils['id']; ?>">
						<option value="1">1 Ngày</option>
					</select>
				</td>
			</tr>
			<?php endif;?>
			<tr>
				<td colspan="2" style="text-align: center;">
					<a class="button btn-recharge" onclick="recharge_vip('<?php echo $item_chils['id'];?>')" href="javascript:;">Mua Vip</a>
				</td>
			</tr>
		</table>
	</div>
	<?php endforeach;?>
	<?php endif;?>
	<?php endforeach;?>
	<?php endif;?>
</div>
<script>
$(document).ready(function(){
	setTimeout(function(){
		$(".alert-success, .alert-error").fadeOut();
	},2000);

	$(".choose-day").on("change",function(){
		var number_day = $(this).val();
		var current_point	= $(this).attr('point');
		var _id_view_point	= $(this).attr('rels');
		var new_point = 50000;
		if(parseInt(number_day) == 1 ){
			new_point = 50000;
		}else if(parseInt(number_day) == 7){
			new_point = 300000;
		}else if(parseInt(number_day) == 30){
			new_point = 1000000;
		}
		//var new_point = (parseInt(number_day) * parseInt(current_point);
		$("#"+_id_view_point).html(new_point);
		$("#"+_id_view_point).formatCurrency({symbol:'',});
	});
});
function recharge_vip( genre ){
	var genre_id = parseInt(genre);
	var number_day = $("#num-day-"+genre_id).val();
	if(genre_id > 0 && parseInt(number_day) > 0){
		window.location.href = '/mua-vip?genre='+genre_id+'&_d='+number_day;
	}
}
</script>