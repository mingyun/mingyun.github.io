<?php
/**
 * 定义API抽象类
*/
abstract class Api {

	const JSON = 'Json';
	const XML = 'Xml';
	const ARR = 'Array';
	
	/**
	* 定义工厂方法
	* param string $type 返回数据类型
	*/
	public static function factory($type = self::JSON) {
		$type = isset($_GET['format']) ? $_GET['format'] : $type;
		$resultClass = ucwords($type);
		require_once('./Response/' . $type . '.php');
		return new $resultClass();
	}

	abstract function response($code, $message, $data);
}