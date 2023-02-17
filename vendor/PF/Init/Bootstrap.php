<?php
	namespace PF\Init;

	abstract class Bootstrap {

		protected $routes = array();
		
		public function __construct(){
			$this->initRoutes();
			$this->run($this->getUrl());
		}

		public function __get($atributo){
			return $this->$atributo;
			
		}

		public function __set($atributo, $valor){
			$this->$atributo = $valor;
		}

		protected abstract function initRoutes();

		protected function run($url){

			foreach($this->routes as $route){
				if($route['index'] == $url){
					$class = "App\\Controllers\\" . ucfirst($route['controller']);
					$action = $route['action'];

					$controller = new $class();
					$controller->$action();
				}
			}
		}

		protected function getUrl(){
			return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH );
		}

	}

?>