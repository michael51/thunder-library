<?php
/**
 * Created by PhpStorm.
 * Author: 雷霆科技 <michaelray@vip.qq.com> <http://www.thunderfuture.com>
 * Date: 2020/4/9
 * Time: 17:56
 */

include_once './vendor/autoload.php';

use MichaelRay\ThunderLibrary\tools\Util;

echo '产生32位hash：'.Util::createUniq32HashId().PHP_EOL;
echo '产生编号1：'.Util::createUniquelyNumberCode(19,2).PHP_EOL;
echo '产生编号2：'.Util::createUniquelyNumberCodeByMicroTime(2).PHP_EOL;
echo '产生大小混合hash：'.Util::createHash('').PHP_EOL;
