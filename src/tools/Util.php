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
	 * 生成唯一32位hash
	 * Author: MichaelRay
	 * Date: 2020/3/28
	 * Time: 17:24
	 * @return string
	 */
	public static function createUniq32HashId(){
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()+-';
		$random = $chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)];//Random 5 times
		$content = uniqid().$random;  // 类似 5443e09c27bf4aB4uT
		return md5($content);
	}

	/**
	 * 基于时间戳生成唯一数字编码（通常用于产品编号或者订单编号）
	 * Author: MichaelRay
	 * Date: 2020/3/27
	 * Time: 17:56
	 * @param $length
	 * @return string
	 */
	public static function createUniquelyNumberCode($length, $prefix){
		$time = time() . '';
		if ($length < 10) $length = 10;
		$string = ($time[0] + $time[2]) . substr($time, 2) . rand(0, 9);
		while (strlen($string) < $length) $string .= rand(0, 9);
		return $prefix.$string;
	}

	/**
	 * 基于微秒生成一个唯一数字编码（和上面方法差不多，上面更灵活）
	 * Author: MichaelRay
	 * Date: 2020/4/13
	 * Time: 20:43
	 * @param string $prefix
	 * @return string
	 */
	public static function createUniquelyNumberCodeByMicroTime ($prefix = '')
	{
		list($microTime, $sec) = explode(' ', microtime());
		$microTime = floatval($microTime);
		$microTime = explode(".", $microTime)[1];
		$order_number = $sec . $microTime;

		return $prefix . $order_number . rand(100, 999);
	}

	/**
	 * 创建一个包含大小写的hash(推荐)
	 * 最长23
	 * Author: MichaelRay
	 * Date: 2020/4/13
	 * Time: 21:44
	 * @param string $str
	 * @param int $length
	 * @return bool|string
	 */
	public static function createHash ($str = '', $length = 23, $prefix = '', $suffix = '')
	{
		if(!$str) $str = microtime();

		$md5 = md5($str, true);
		$pos = 0;
		$res = "";
		while (strlen($res) < $length && ($bin = substr($md5, $pos, 4)) != "") {
			$uint = sprintf("%u", unpack("Nint", $bin)['int']);
			$res .= self::handleHash($uint);
			$pos += 4;
		}

		return $prefix.substr($res, 0, $length).$suffix;
	}

	private static function handleHash ($str)
	{
		$table = array_merge(range(0, 9), range('A', "Z"), range('a', "z"));

		$arr62 = [];
		$div = $str;
		do {
			$mod = $div % 62;
			array_unshift($arr62, $table[ $mod ]);
			$div = intval($div / 62);
		} while ($div != 0);

		return implode("", $arr62);
	}
}
