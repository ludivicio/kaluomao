<?php 

class Category {

	// 组合一维数组
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
		return $arr;
	}

	// 组合多维数组
	public static function unlimitForLayer($cates, $pid = 0, $name = 'child') {
		$arr = array();
		foreach($cates as $val) {
			if($val['pid'] == $pid) {
				$val[$name] = self::unlimitForLayer($cates, $val['id'], $name);
				$arr[] = $val;
			}
		}

		return $arr;
	}

	// 传递子类ID，获取父类ID
	public static function getParents($cates, $id) {
		$arr = array();
		foreach($cates as $val) {
			if($val['id'] == $id) {
				$arr[] = $val;
				$arr = array_merge(self::getParents($cates, $val['pid']), $arr);
			}
		}

		return $arr;
	}


	// 传递一个父级分类ID，返回所有子级分类
	public static function getChildren($cates, $pid) {
		$arr = array();
		foreach($cates as $val) {
			if($val['pid'] == $pid) {
				$arr[] = $val;
				$arr = array_merge($arr, self::getChildren($cates, $val['id']));
			}
		}
		return $arr;
	}

	// 传递一个父级分类ID，返回所有子级分类ID
	public static function getChildIds($cates, $pid) {
		$arr = array();
		foreach($cates as $val) {
			if($val['pid'] == $pid) {
				$arr[] = $val['id'];
				$arr = array_merge($arr, self::getChildren($cates, $val['id']));
			}
		}
		return $arr;
	}

}

?>