<?php
/**
 * This class define error code
 *
 * @author Dang Ngoc Thanh
 *
 */

abstract class AppConst
{
	const RUN_BG_FILE = 'runbg'; // for run bat file

	const LOGIN_ADMIN 	='Admin';
	const LOGIN_USER 	='User';
	
	const DELETED_FLAG = 1;
	const UN_DELETE_FLAG = 0;
  	
	const GROUP_USER = 0;
	
	const GROUP_ADMIN = 1;
	
	const CONFIRM_FLAG= 1;
	
	const LIKE = 1;
	const UN_LIKE = 0;
     
   	const ACCEPT_FLAG = 1;
   	const UN_ACCEPT_FLAG = 0;
   	const KEY_256_ENCRYPT_PASSWORD = '4c6a281ed3e01b6ed0850dba346183ac';
   	const NUM_PAGING_NEWS_LIST = 5;
   	const LIMIT_PADDING_API = 20;
   	const MESSAGE_SUCCESS 	= 1;
   	const MESSAGE_ERROR		= 0;
   	
   	const ACCESS_KEY_1_PAY = 'qz5rd68mu4ij1ihlw1q1';
   	
   	const SECRET_1_PAY = 'ifub1x16gv0hb6wfj1vdsqt4m7zxc4sp';
   	
   	const API_1_PAY 	= 'https://api.1pay.vn/card-charging/v2/topup';
   	
  	const UPLOAD_DIR_USER_PHOTO = "upload/user_photo/";

} 
