<?php
	namespace App\Controllers;

	//recursos do framework
	use PF\Controller\Action;
	use PF\Model\Container;

	class AppController extends Action {

		public function timeline() {

			$this->validaAutenticacao();

			//recuperação dos tweets
			$tweet = Container::getModel('Tweet');
			$tweet->__set('id_usuario', $_SESSION['id']);

			//variaveis de paginação
			$total_registros_pagina = 10;
			$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
			$deslocamento = ($pagina -1) * $total_registros_pagina;

			//$tweets = $tweet->getAll();
			$this->view->tweets = $tweet->getPorPagina($total_registros_pagina, $deslocamento);
			$total_tweets = $tweet->getTotalRegistros();
			$this->view->total_paginas = ceil($total_tweets['total'] / $total_registros_pagina);
			$this->view->pagina_ativa = $pagina;


			$this->carregaDadosUsuario();

			$this->render('timeline');
		}

		public function tweet() {

			$this->validaAutenticacao();

			$tweet = Container::getModel('Tweet');

			$tweet->__set('tweet', $_POST['tweet']);
			$tweet->__set('id_usuario', $_SESSION['id']);

			$tweet->salvar();

			header('Location: /timeline');
		}

		public function quemSeguir() {

			$this->validaAutenticacao();
			$this->carregaDadosUsuario();

			$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';
			$usuarios = array();

			if($pesquisarPor != ''){

				$usuario = Container::getModel('Usuario');
				$usuario->__set('nome',$pesquisarPor);
				$usuario->__set('id',$_SESSION['id']);
				$usuarios = $usuario->getAll();
			}

			$this->view->usuarios = $usuarios;

			$this->render('quemSeguir');

		}

		public function acao(){

			$this->validaAutenticacao();

			$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
			$id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

			$usuario = Container::getModel('Usuario');
			$usuario->__set('id', $_SESSION['id']);

			if($acao == 'seguir'){

				$usuario->seguirUsuario($id_usuario_seguindo);

			}else if($acao == 'deixarDeSeguir') {

				$usuario->deixarSeguirUsuario($id_usuario_seguindo);
			}

			header('Location: /quemseguir');
		}

		public function removeTweet() {

			$this->validaAutenticacao();

			$id = isset($_GET['id']) ? $_GET['id'] : '';

			$tweet = Container::getModel('Tweet');
			$tweet->__set('id',$id);
			$tweet->remover();

			header('Location: /timeline');
		}

		public function carregaDadosUsuario() {

			$usuario = Container::getModel('Usuario');
			$usuario->__set('id', $_SESSION['id']);

			$this->view->info_usuario = $usuario->getInfoUsuario();
			$this->view->total_tweets = $usuario->getTotalTweets();
			$this->view->total_seguindo = $usuario->getTotalSeguindo();
			$this->view->total_seguidores = $usuario->getTotalSeguidores();
		}

		public function validaAutenticacao() {

			session_start();

			if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) ||  $_SESSION['nome'] == ''){
				header('Location: /?login=erro');
			}
		}

	}
?>