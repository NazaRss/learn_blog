<?php

namespace core;

class users {

	public static function isAuth() {
		if (!isset($_SESSION['auth'])) {
				if ($_COOKIE['login'] == md5('admin') && $_COOKIE['passwords'] == md5('qwerty')) {
					$_SESSION['auth'] = true;
				} else { 
					return false;
				}
		} 
		return true;	
	}	
}	
