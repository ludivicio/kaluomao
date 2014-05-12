<?php 

class Category {

	public static function unlimitForLevel($cates, $html = '--', $pid = 0, $level = 0) {
		$arr = array();
		foreach($cates as $val) {
			if($val['pid'] == $pid) {
				$val['level'] = $level + 1;
				$val['html'] = str_repeat($html, $level);
				$arr[] = $val;
				$arr = array_merge($arr, self::unlimitForLevel($cates, $html, $val['id'], $level + 1));
			}
		}
		return $cates;
	}






















}




?>