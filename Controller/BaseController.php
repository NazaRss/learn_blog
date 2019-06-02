<?php

namespace Controller;

use Core\Users;
use Core\Request;

class BaseController
{
	protected $content;
	protected $auth;
	protected $request;
	
	public function __construct(Request $request)
	{
		$this->auth = Users::isAuth();
		$this->request = $request;
	}
	
	public function get404()
	{
		$this->content = '<h3>Page Not Found Error 404</h3>';
		$this->render();
		die;
	}
	
	public function tmpGenerate($path, $vars = [])
	{
	    ob_start();
	    extract($vars);
	    include($path);
	    $res = ob_get_clean();
	    return $res;
	}

	public function render()
	{
		echo $this->tmpGenerate('view/v_main.php', [
			'auth' => $this->auth,
			'content' => $this->content
		]);
	}
	
	protected function getRedirect($url)
	{
		header("Location: $url");
		die;
	}
}