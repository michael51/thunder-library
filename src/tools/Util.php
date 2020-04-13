<?php
/**
 * Created by PhpStorm.
 * Author: 雷霆科技 <michaelray@vip.qq.com> <http://www.thunderfuture.com>
 * Date: 2020/4/7
 * Time: 21:18
 */
namespace MichaelRay\ThunderLibrary\tools;

use MichaelRay\ThunderLibrary\logic\UtilLogic;

class Util
{
	public static function exeUrl($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		$output = curl_exec($ch);
		curl_close($ch);

		return json_decode($output, true);
	}

	public static function getUUID ()
	{
		$char_id = self::getHash();

		return $char_id;
	}

	public static function removeValueByArrValue (&$arr, $value)
	{
		foreach ($arr as $key=> $v)
		{
			if ($v == $value){
				unset($arr[$key]);
			}
		}
	}

	public static function handleLocalDomainForUrl ($url)
	{
		if(strpos($url,'http')!==false) {
			return $url;
		} else {
			return self::getHostUrl().$url;
		}
	}

	public static function getHostUrl ()
	{
		if (UtilLogic::isHttps()) {
			return 'https://' . $_SERVER['HTTP_HOST'] . '/';
		} else {
			return 'http://' . $_SERVER['HTTP_HOST'] . '/';
		}
	}


	/**
	 * 急于时间戳生成唯一编码
	 * Author: MichaelRay
	 * Date: 2020/3/27
	 * Time: 17:56
	 * @param $length
	 * @return string
	 */
	public static function getUniquelyNumberCode($length, $prefix){
		$time = time() . '';
		if ($length < 10) $length = 10;
		$string = ($time[0] + $time[2]) . substr($time, 2) . rand(0, 9);
		while (strlen($string) < $length) $string .= rand(0, 9);
		return $prefix.$string;
	}

	/**
	 * 生成唯一32位hash
	 * Author: MichaelRay
	 * Date: 2020/3/28
	 * Time: 17:24
	 * @return string
	 */
	public static function getUniq32HashId(){
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()+-';
		$random = $chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)];//Random 5 times
		$content = uniqid().$random;  // 类似 5443e09c27bf4aB4uT
		return md5($content);
	}

	/**
	 * 生成一个唯一的15位hashID（由于急于时间戳，唯一性欠佳，可用于后台更新不连续情况）
	 * Author: MichaelRay
	 * Date: 2020/4/9
	 * Time: 18:05
	 * @return string
	 */
	public static function getUniq15HashId(){
		return uniqid(mt_rand(10, 100));
	}
}
