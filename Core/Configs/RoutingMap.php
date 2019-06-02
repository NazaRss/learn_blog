<?php
return 
[
	'/' => [
		'controller' => 'Controller\ArticleController',
		'action' => 'indexAction'
	],
	
	'/article' => [
		'controller' => 'Controller\ArticleController',
		'action' => 'oneAction',
	],
	
	'/add' => [
		'controller' => 'Controller\ArticleController',
		'action' => 'addAction',
		
	],
	'/default' => [
		'controller' => 'Controller\BaseController',
		'action' => 'get404'
		
	],
	'/edit' => [
		'controller' => 'Controller\ArticleController',
		'action' => 'editAction'
		
	],
	'/delete' => [
		'controller' => 'Controller\ArticleController',
		'action' => 'deleteAction'
		
	],
	'/login' => [
		'controller' => 'Controller\ArticleController',
		'action' => 'loginAction'
		
	]
];