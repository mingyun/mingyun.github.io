<?php

require_once "transfer_config.php";

class Transfer {
    const ZH_ASCII_LOW = 224;
    const ZH_ASCII_HIGHT = 239;
    public static $utf8_gb2312;
    public static $utf8_big5;

    public function __construct() {
        global $UTF8_GB2312;
        global $UTF8_BIG5;
        self::$utf8_gb2312 = $UTF8_GB2312;
        self::$utf8_big5 = $UTF8_BIG5;
    }

    public function cnToTw($string) {
        $traditional = "";     //繁体变量初始化
        $length = strlen($string);  //提取string字符串的ASCII码长度，注意一个中文字符对应于3位
        $count = 0;
        while ($count < $length) {
            //获取$count位置上的ASCII值
            $ascii = ord($string{$count});
            if ($ascii >= self::ZH_ASCII_LOW && $ascii <= self::ZH_ASCII_HIGHT) {
                if (($temp = strpos(self::$utf8_gb2312, $string{$count} . $string{$count + 1} . $string{$count + 2})) !== false) {
                    $traditional .= self::$utf8_big5{$temp} . self::$utf8_big5{$temp + 1} . self::$utf8_big5{$temp + 2};
                    $count += 3;
                    continue;
                }
            }
            $traditional .= $string{$count++};
        }
        return $traditional;
    }

    public function twToCn($string) {
        $simplified = "";
        $length = strlen($string);
        $count = 0;
        while ($count < $length) {
            //获取$count位置上的ASCII值
            $ascii = ord($string{$count});
            if ($ascii >= self::ZH_ASCII_LOW && $ascii <= self::ZH_ASCII_HIGHT) {
                if (($temp = strpos(self::$utf8_big5, $string{$count} . $string{$count + 1} . $string{$count + 2})) !== false) {
                    $simplified .= self::$utf8_gb2312{$temp} . self::$utf8_gb2312{$temp + 1} . self::$utf8_gb2312{$temp + 2};
                    $count += 3;
                    continue;
                }
            }
            $simplified .= $string{$count++};
        }
        return $simplified;
    }
}

