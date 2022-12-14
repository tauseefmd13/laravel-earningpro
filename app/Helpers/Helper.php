<?php

if(!function_exists('set_active')) {
	function set_active($path, $active = 'active') {
		if( is_array($path) ) {
			return call_user_func_array('Request::is', (array)$path) ? $active : '';
		}
		return request()->path() == $path ? $active : '';
	}
}

if(!function_exists('str_limit')) {
    function str_limit($value, $limit = 100, $end = '...') {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }

        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
    }
}
