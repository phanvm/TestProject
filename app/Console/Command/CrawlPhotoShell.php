<?php
App::uses("AppUntility", "Lib");
class CrawlPhotoShell extends Shell{
	
	public $uses = array();
	
	public function crawl(){
		AppUntility::logShell('START ' . __METHOD__, 'INFO');
		$args = $this->args;
		if(!empty($args)){
			$crawl_link = $args[0];
			$this->proccessCrawl( $crawl_link );
		}else{
			AppUntility::logShell(__('Please input crawl link'), 'ERROR');
		}
		AppUntility::logShell('END ' . __METHOD__, 'INFO');
	}
	
	
	private function proccessCrawl( $url ){
		
		$html = file_get_html($url);
		
		foreach ($html->find('img') as $element) {
			
			$extension = pathinfo($element->src, PATHINFO_EXTENSION);
			
			if (in_array(strtolower($extension), array('png', 'jpg'))){
				$download_dir = 'crawl/';
				AppUntility::downloadFile($element->src ,$download_dir);
				
			}
		}
	}
}