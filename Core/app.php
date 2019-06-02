<?php
namespace Core;

class App
{
	private $request;
	private $routs;

	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->routs = include_once ROOT . '/Core/Configs/RoutingMap.php';
	}

	public function go()
	{
		$params = $this->getRoutByRequest();
		
		if (!$params) {
			$params = $this->getRoutByParams('/default');
		}
		
		$ctrl = new $params['controller']($this->request);
		$action = $params['action'];
		$ctrl->$action();

		return $ctrl->render();
	}

	private function getRoutByRequest()
	{
		return isSet($this->routs[$this->request->rout]) ? $this->routs[$this->request->rout] : false;
	}
	
	private function getRoutByParams($rout)
	{
		return isset($this->routs[$rout]) ? $this->routs[$rout] : false;
	}	
	
}