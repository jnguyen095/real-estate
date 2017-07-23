<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/21/2017
 * Time: 10:11 AM
 */


if( ! function_exists('relative_time'))
{
	function relative_time($datetime)
	{
		$CI =& get_instance();
		$CI->lang->load('date');

		if(!is_numeric($datetime))
		{
			$val = explode(" ",$datetime);
			$date = explode("-",$val[0]);
			$time = explode(":",$val[1]);
			$datetime = mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]);
		}

		$difference = time() - $datetime;
		$periods_vi = array("giây", "phút", "giờ", "ngày", "tuần", "tháng", "năm", "decade");
		$lengths = array("60","60","24","7","4.35","12","10");

		if($difference < 1)
		{
			$difference = -$difference;
		}
		for($j = 0; $difference >= $lengths[$j]; $j++)
		{
			$difference /= $lengths[$j];
		}
		$difference = round($difference);

		return "$difference $periods_vi[$j] trước";
	}


}
