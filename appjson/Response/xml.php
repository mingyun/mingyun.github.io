<?php
/**
* @author by singwa
* @date
*/

class Xml extends Api {
	public function response($code, $message = '', $data = array()) {
		if(!is_numeric($code)) {
			return '';
		}

		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => $data
		);

		header('Content-Type:text/xml');
		$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
		$xml .= "<root>";
		$xml .= self::xmlToEncode($result);
		$xml .= "</root>";
		echo $xml;
	}

	public static  function xmlToEncode($result) {
		$xml = $attr = '';
		foreach($result as $key => $value) {
			if(is_numeric($key)) {
				$attr = " id='" . $key . "'";
				$key = "item";
			}
			$xml .= "<{$key}{$attr}>";
			$xml .= is_array($value) ? self::xmlToEncode($value) : $value;
			$xml .= "</{$key}>\n";
		}
		return $xml;
	}
}