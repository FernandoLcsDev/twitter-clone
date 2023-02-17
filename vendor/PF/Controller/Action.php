<?php
	namespace PF\Controller;

	abstract class Action {

		protected $view;

		public function __construct(){
			$this->view = new \stdClass();
		}

		protected function render($view, $layout = 'layout'){
			$this->view->page = $view;
			if(file_exists("../App/Views/".$layout.".php")){
				require_once "../App/Views/".$layout.".php";
			}else{
				$this->content();
			}
			
		}

		protected function content(){
			$actClass = get_class($this);
			$actClass = str_replace('App\\Controllers\\','',$actClass);
			$actClass = ucfirst(str_replace('Controller','',$actClass));
			require_once "../App/Views/".$actClass."/".$this->view->page.".php";
		}
	}


?>