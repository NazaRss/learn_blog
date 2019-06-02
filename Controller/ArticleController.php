<?php

namespace Controller;

use Model\ArticleModel;
use Core\request;
use Core\Users;

class ArticleController extends BaseController {

	public function indexAction()
	{ 

		$articles = ArticleModel::Instance()->getAll();
  

	    if ($articles === false){
	        echo 'Возникла ошибка!';
	    }
	    elseif ($articles  == []){
	        echo 'Нет новостей для отображения';
	    }

	    $this->content = $this->tmpGenerate('view/v_index.php',[
            'articles' => $articles,
			'auth' => $this->auth
        ]);
	}
	
	public function oneAction() 
	{
		$id_article = (int)$this->request->getGet()['id'];
		
		if (!isset($id_article)) {
			$this->get404();
		}
		
		$article = ArticleModel::Instance()->getOne($id_article);
			
		if (!$article) {
			$this->get404();
		}
				
		$this->content = $this->tmpGenerate('view/v_article.php', [
				'post' => $article,
				'id_news' => $id_article,
				'auth' => $this->auth
			]);
	}
		
	public function addAction() 
	{  

		if(!$this->auth) { 
			header('Location: /login');
			exit();
		}          
	
		$post = $this->request->getPost();
	
		if (count($post) > 0){
			// POST
			
			$title = trim(htmlspecialchars ($post['title']));
	        $content = trim(htmlspecialchars ($post['content']));
			
			
			$errors = ArticleModel::Instance()->validate_article($title, $content);
						 
			if (empty($errors)) {
			
				ArticleModel::Instance()->add(['title' => "$title", 'content' => "$content"]);
				header ('Location: /');
				exit();

			} else {
				$msg = '|Все поля должны быть заполнены правильно!|';
			} 
		} else {	
			echo '<br>';
			// GET
			$title = '';
			$content = '';
			$errors = [];
			$msg = '| Здравствуйте, заполните поля. |';
			
		}
		
		$this->content = $this->tmpGenerate('view/v_add.php', [
			'content' => $content,
			'title' => $title,
			'msg' => $msg,
			'errors' => $errors
		]);
	}	
	
	public function editAction() 
	{
		if(!$this->auth) { 
			header('Location: /login');
			$_SESSION['back'] = $this->request->getServer()['REQUEST_URI'];
			exit();
		}
		
		$id_news = (int)$this->request->getGet()['id'];

		if (!isset($id_news)) {
			$this->get404();
		}
		
		$article = ArticleModel::Instance()->getOne($id_news);
			
		if (!$article) {
			$this->get404();
		}
		
		
		$title = $article['title']; 
		$content = $article['content'];	
		
		$post = $this->request->getPost();
		
		//Блок редактирования статьи
		if(count($post) > 0){			
			$title = trim(htmlspecialchars($post['title']));
			$content = trim(htmlspecialchars($post['content']));
			
			$errors = ArticleModel::Instance()->validate_article($title, $content);
			
			if (empty($errors)) {
			
				ArticleModel::Instance()->edit($id_news,['title' => "$title", 'content' => "$content"]);
				header ("Location: article?id=$id_news");
				exit();

			}	
			else { 
				$msg = '| Заполните все поля правильно! |'; 
			}
		}
		else {
			$msg = '| Отредактируйте статью. |';
			$errors = [];
		}
	
		$this->content = $this->tmpGenerate('view/v_edit.php', [
				'title' => $title,
				'content' => $content,
				'errors' => $errors,
				'id_news' => $id_news,
				'msg' => $msg
			]);
	}

	public function deleteAction() 
	{
		if(!$this->auth) { 
			header('Location: /login');
			exit();
		}
	
	$id_news = $this->request->getGet()['id'];			
	
		$article = ArticleModel::Instance()->getOne($id_news);
			
		if (!$article) {
			$this->get404();
		}

	if ($article['id_news']) {
		ArticleModel::Instance()->delete($id_news);
		$msg = "Статья <b>". $article['title'] . "</b> успешно удалена!<br>";
	} else {
		$msg = "Такой статьи не существует!<br>";
	}
	
	$this->content = $this->tmpGenerate('view/v_del_article.php', [
			'msg' => $msg
		]);
		
	}
	
	public function loginAction() 
	{
		
		$login = '';
		$password = '';
		
		$post = $this->request->getPost();
		
		if(count($post) > 0){
			
			if($post['login'] == 'admin' && $post['password'] == 'qwerty'){
				$_SESSION['auth'] = true;

				
				if ($post['remember'] == 'on'  ) {
					setcookie('login', 'admin' , time() + 3600 * 24 * 7);
					setcookie('password', 'qwerty', time() + 3600 * 24 * 7);
				} 
				
				header("Location: /");  
				exit();
				
			} else { 
			$msg = 'Введён не правильно логин или пароль';
			}	
		}
		else{
			unset($_SESSION['auth']);
			setcookie('login', md5($login), time()-1);
			setcookie('password', md5($password), time()-1);
			
			$msg = 'Введите логин и пароль';
		
		$this->content = $this->tmpGenerate('view/v_login.php', [
			'msg' => $msg
		]);
		}	
	}
}
