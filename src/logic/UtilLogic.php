<?php
/**
 * Created by PhpStorm.
 * Author: 雷霆科技 <michaelray@vip.qq.com> <http://www.thunderfuture.com>
 * Date: 2020/4/9
 * Time: 17:54
 */

namespace MichaelRay\ThunderLibrary\logic;

class UtilLogic
{
	/**
	 * PHP判断当前协议是否为HTTPS
	 */
	public static function isHttps() {
		if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
			return true;
		} elseif ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
			return true;
		} elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
			return true;
		}
		return false;
	}

	public static function isWechat(){
		if ( strpos($_SERVER['HTTP_USER_AGENT'],
				'MicroMessenger') !== false ) {
			return true;
		}
		return false;
	}

	public static function isMobile (){
		$agent      = strtolower($_SERVER['HTTP_USER_AGENT']);
		$is_pc      = (strpos($agent, 'windows nt')) ? true : false;
		$is_mac     = (strpos($agent, 'mac os')) ? true : false;
		$is_iphone  = (strpos($agent, 'iphone')) ? true : false;
		$is_android = (strpos($agent, 'android')) ? true : false;
		$is_ipad    = (strpos($agent, 'ipad')) ? true : false;
		if ($is_pc) {
			return false;
		}
		if ($is_mac) {
			return true;
		}
		if ($is_iphone) {
			return true;
		}
		if ($is_android) {
			return true;
		}
		if ($is_ipad) {
			return true;
		}
	}
}
