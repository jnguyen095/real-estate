<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/21/2017
 * Time: 10:11 AM
 */


if ( ! function_exists('seo_url'))
{
	function seo_url($string) {
		$search = array (
			'#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
			'#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
			'#(ì|í|ị|ỉ|ĩ)#',
			'#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
			'#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
			'#(ỳ|ý|ỵ|ỷ|ỹ)#',
			'#(đ)#',
			'#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
			'#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
			'#(Ì|Í|Ị|Ỉ|Ĩ)#',
			'#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
			'#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
			'#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
			'#(Đ)#',
			"/[^a-zA-Z0-9\-\_]/",
		) ;
		$replace = array (
			'a',
			'e',
			'i',
			'o',
			'u',
			'y',
			'd',
			'A',
			'E',
			'I',
			'O',
			'U',
			'Y',
			'D',
			'-',
		) ;
		$string = preg_replace($search, $replace, $string);
		$string = preg_replace('/(-)+/', '-', $string);
		$string = strtolower($string);
		return $string;
	}
}

if ( ! function_exists('keyword_maker'))
{
	function keyword_maker($string) {
		$words = preg_replace('/[0-9.,!?]+/', '', $string);
		$words = preg_replace('!\s+!', ' ', $words);
		$words = preg_replace("/[\s_]/", ',', $words);
		return $words;
	}
}

if ( ! function_exists('limit_text')) {
	function limit_text($text, $limit)
	{
		if (str_word_count($text, 0) > $limit) {
			$words = str_word_count($text, 2);
			$pos = array_keys($words);
			$text = substr($text, 0, $pos[$limit]) . '...';
		}
		return $text;
	}
}
