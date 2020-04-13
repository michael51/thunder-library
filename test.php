<?php
/**
 * Created by PhpStorm.
 * Author: 雷霆科技 <michaelray@vip.qq.com> <http://www.thunderfuture.com>
 * Date: 2020/4/9
 * Time: 17:56
 */

include_once './vendor/autoload.php';

use MichaelRay\ThunderLibrary\tools\Util;

//echo Util::getUniq15HashId().PHP_EOL;
echo Util::getUniquelyNumberCode(10,2).PHP_EOL;
