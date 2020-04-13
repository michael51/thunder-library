<?php
/**
 * Created by PhpStorm.
 * Author: 雷霆科技 <michaelray@vip.qq.com> <http://www.thunderfuture.com>
 * Date: 2020/4/9
 * Time: 17:56
 */

include_once './vendor/autoload.php';

use MichaelRay\ThunderLibrary\tools\Util;

echo '产品32位hash：'.Util::createUniq32HashId().PHP_EOL;
echo '产品编号1：'.Util::createUniquelyNumberCode(19,2).PHP_EOL;
echo '产品编号2：'.Util::createUniquelyNumberCodeByMicroTime(2).PHP_EOL;
echo '产品23位hash：'.Util::createUniq23HashId().PHP_EOL;
