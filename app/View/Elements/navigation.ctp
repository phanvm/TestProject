<div  style="width: 100%;background: #78b43d;">
	<div class="row">
		<div class="large-12 columns">
		<!-- Navigation -->
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
					<!-- Title Area -->
					<li class="name">
						<h1>
							<a href="#"> <img width="140px" src="/img/logo.png"> </a>
						</h1>
					</li>
					<li class="toggle-topbar menu-icon"><a href="#"><span>menu</span> </a>
					</li>
				</ul>
			
				<section class="top-bar-section">
					<!-- Right Nav Section -->
					<ul class="right">
						<li><a href="/">Trang Chủ</a></li>
						<li>
							<?php echo $this->Html->Link( __('Thống kê bạc nhớ') , array('controller'=>'home', 'action' => 'genre', 'slug' => $this->Common->slug(__('Thống kê bạc nhớ')) , 'id' => AppConst::THONG_KE_BAC_NHO) , array('escape' => false))?>
						</li>
						<li>
							<?php echo $this->Html->Link( __('Vip Bạch Thủ') , array('controller'=>'home', 'action' => 'genre', 'slug' => $this->Common->slug(__('Vip Bạch Thủ')) , 'id' => AppConst::VIP_BACH_THU) , array('escape' => false))?>
						</li>
						<li>
						<?php echo $this->Html->Link( __('Vip Song Thủ') , array('controller'=>'home', 'action' => 'genre', 'slug' => $this->Common->slug(__('Vip Song Thủ')) , 'id' => AppConst::VIP_SONG_THU) , array('escape' => false))?>
						</li>
					</ul>
				</section>
			</nav>
		</div>
	</div>
</div>
<!-- End Top Bar -->
<script>
    $(document).foundation();
</script>