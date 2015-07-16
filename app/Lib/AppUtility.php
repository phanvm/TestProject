<?php
/**
 * This class content commont function.
 *
 * @author PhanVM
 * @create 2015/07/07
 */
abstract class AppUtility
{
	//put your code here
	static function send_push_notification($registatoin_ids, $message) {
		// Set POST variables
		$url = 'https://android.googleapis.com/gcm/send';
	
		$fields = array(
				'registration_ids' => $registatoin_ids,
				'data' => $message,
		);
	
		$headers = array(
				'Authorization: key=' . GOOGLE_API_KEY,
				'Content-Type: application/json'
		);
		//print_r($headers);
		// Open connection
		$ch = curl_init();
	
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
	
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	
		// Execute post
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
	
		// Close connection
		curl_close($ch);
		return $result;
	}
	
	
	static function sendPushNotificationKidsApp($registatoin_ids, $message){
		// Set POST variables
		$url = 'https://android.googleapis.com/gcm/send';
		 
		$fields = array(
				'registration_ids' => $registatoin_ids,
				'data' => $message,
		);
		 
		$headers = array(
				'Authorization: key=' . GOOGLE_API_KEY_KIDS_APP,
				'Content-Type: application/json'
		);
		//print_r($headers);
		// Open connection
		$ch = curl_init();
		 
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		 
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		 
		// Execute post
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		 
		// Close connection
		curl_close($ch);
		return $result;
	}
	
	static function getStatusCode($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
		curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
	
		return $httpcode;
	}
	
	static public function execAsynchronously($command){
		if (substr(php_uname(), 0, 7) == "Windows"){
			$command = escapeshellcmd(dirname(dirname(__FILE__)).'\\Console\\' .AppConst::RUN_BG_FILE.' '.$command);
			CakeLog::write('debug','Command ='.$command);
			//return pclose(popen("start /B ". $command, "r"));
			return pclose(popen('start "wphp" /min '.$command, "r"));
		}
	
		$command = escapeshellcmd('sh '. dirname(dirname(__FILE__)).'/Console/' .AppConst::RUN_BG_FILE.' '.$command);
		//CakeLog::write('debug','Command ='.$command);
		return exec($command . " > /dev/null &");
	}
	
	static function logShell($messages,$type){
		$log = __("%s %s %s \n",  date('Y-m-d H:i:s'),$type,$messages);
		echo $log;
	}
	
	/**
	 * This function download_file()
	 * @param unknown $url
	 * @param string $downloaddir
	 * @return string
	 */
	static public function download_file( $url , $downloaddir = null ){
		try{
			if($downloaddir == null){
				$downloaddir = 'upload/' . date('Y-m-d').'/';
			}
			if (!file_exists($downloaddir)) {
				mkdir( $downloaddir, 0777);
			}
	
			$extension = pathinfo($url, PATHINFO_EXTENSION);
			$photo_name  = md5(basename($url,".".$extension).time()).'.'.$extension;
			$downloaddir .= $photo_name;
			try {
				$fp = fopen($downloaddir, 'wb');
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_FILE, $fp);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_exec($ch);
				curl_close($ch);
				fclose($fp);
				return "/".$downloaddir;
					
			} catch (Exception $e) {
				var_dump($e->getMessage()); die;
			}
		}catch (Exception $ex){
			var_dump($ex->getMessage()); die;
		}
		return null;
	}
	
	public static function downloadFile ($url, $path) {
		$ch = curl_init ($url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
		$rawdata=curl_exec($ch);
		curl_close ($ch);
		 
		$fp = fopen($path,'w');
		fwrite($fp, $rawdata);
		fclose($fp);
	}
	
	public static function slug($string) {
		$string = AppUtility::stripUnicode($string);
		$string = preg_replace("`\[.*\]`U","",$string);
		$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
		$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
		//  $string = $string.'.html';
		return strtolower(trim($string, '-'));
	}
	
	public static function stripUnicode($str){
		if(!$str) return false;
		$unicode = array(
				'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
				'd'=>'đ|Đ',
				'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
				'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
				'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
				'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
				'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		);
		foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
		return $str;
	}
	
	public static function __set_message($message , $type ){
		switch ( $type ){
			case 1:{
				$this->Session->setFlash( $message, 'default' , array('class'=>'alert alert-success alert-dismissable'));
				break;
			}
			case 0:{
				$this->Session->setFlash( $message, 'default' , array('class'=>'alert alert-danger alert-dismissable'));
				break;
			}
		}
	}
	
	
	/**
	 * This function validate_image_file()
	 * @author PhanVM
	 * @param unknown $files
	 */
	public static function validate_image_file( $files = array() ){
		if(empty($files))
			return false;
	
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$extension = @end(explode(".", $files["photo"]["name"]));
	
		if ((($files["photo"]["type"] == "image/gif") || ($files["photo"]["type"] == "image/jpeg") || ($files["photo"]["type"] == "image/jpg") || ($files["photo"]["type"] == "image/png")) && ($files["photo"]["size"] < 300000) && in_array($extension, $allowedExts)){
			return true;
		}
		return false;
	}
	
	
	public static function uploadFile( $files = array() , &$filename){
		
		$extension = @end(explode(".", $files["photo"]["name"]));
		debug($filename);
		debug(AppUtility::slug($filename));
		$filename = time().'_'.AppUtility::slug($filename).'.'.$extension;
		
		$success = move_uploaded_file($files['photo']["tmp_name"],AppConst::UPLOAD_DIR_USER_PHOTO . $filename);
		
		if(!$success) return false ;
		return true;
		
	}
	
}
?>