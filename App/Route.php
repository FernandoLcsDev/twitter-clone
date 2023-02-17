<?php
	namespace App;

	use PF\Init\Bootstrap;

	class Route extends Bootstrap{

		public function initRoutes(){
			$this->routes['home'] = array(
				'index' => '/',
				'controller' => 'indexController',
				'action' => 'index'
			);

			$this->routes['inscreverse'] = array(
				'index' => '/inscreverse',
				'controller' => 'indexController',
				'action' => 'inscreverse'
			);

			$this->routes['registrar'] = array(
				'index' => '/registrar',
				'controller' => 'indexController',
				'action' => 'registrar'
			);

			$this->routes['autenticar'] = array(
				'index' => '/autenticar',
				'controller' => 'AuthController',
				'action' => 'autenticar'
			);

			$this->routes['timeline'] = array(
				'index' => '/timeline',
				'controller' => 'AppController',
				'action' => 'timeline'
			);

			$this->routes['sair'] = array(
				'index' => '/sair',
				'controller' => 'AuthController',
				'action' => 'sair'
			);

			$this->routes['tweet'] = array(
				'index' => '/tweet',
				'controller' => 'AppController',
				'action' => 'tweet'
			);

			$this->routes['quemseguir'] = array(
				'index' => '/quemseguir',
				'controller' => 'AppController',
				'action' => 'quemSeguir'
			);

			$this->routes['acao'] = array(
				'index' => '/acao',
				'controller' => 'AppController',
				'action' => 'acao'
			);

			$this->routes['removeTweet'] = array(
				'index' => '/removeTweet',
				'controller' => 'AppController',
				'action' => 'removeTweet'
			);

			$this->__set('routes', $this->routes);
		}

	}


?>