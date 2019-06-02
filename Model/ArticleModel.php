<?php

namespace model;

class ArticleModel extends BaseModel {	

	public static $instance;
	
	public static function Instance()
	{
		if (self::$instance == null) {
			self::$instance = new ArticleModel();
		}
		
		return self::$instance; 
	}
	
	public function __construct() 
	{
		parent::__construct();
		
		$this->table = 'news';
		$this->pk = 'id_news';
				
	}
	
	public static function validate_article($title, $content) {
		$errors = [];
		
		if ($title == '') {
			$errors[] = 'Название статьи должно быть заполнено.';
		}
		elseif (iconv_strlen($title) < 3) {		
			$errors[] = 'Заголовок статьи должен содержать больше 2 символов';
		}
		
		if ($content == '') {
			$errors[] = 'В статье должно быть что-нибудь написано.';
		}
		
		return $errors;
		
	}
	
}