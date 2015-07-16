<style>
._c_nav{cursor: pointer;}
</style>
<div class="sidebar">
	<ul class="pricing-table" data-equalizer-watch="">
		<li class="title">Danh Mục sản phẩm</li>
		<?php foreach ($list_category as $item):?>
		<li class="bullet-item _c_nav">
			<?php echo $this->Html->Link( $item['Category']['name'] , array('controller'=>'home', 'action' => 'genre', 'slug' => $this->Common->slug($item['Category']['name']) , 'id' => $item['Category']['id']) , array('escape' => false))?>
		</li>
		<?php endforeach;?>
	</ul>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("._c_nav").on("click",function(){
		var redirect = $(this).children('a').attr('href');
		if(redirect != null && redirect != "")
			window.location.href = redirect;
	});
});
</script>
