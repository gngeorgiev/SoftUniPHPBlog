<?php

abstract class BaseController {
	protected $controller;
	protected $action;
	protected $layout = DEFAULT_LAYOUT;
	protected $viewBag = array();
	protected $viewRendered = false;

	public function __construct($controller, $action) {
		$this->controller = $controller;
		$this->action = $action;
		$this->onInit();
	}

	public function &__get($name) {
		if(isset($this->viewBag[$name])) {
			return $this->viewBag[$name];
		}

		if(property_exists($this, $name)) {
			return $this->$name;
		}
		$null = null;
		return $null;
	}	

	public function __set($name, $value) {
		$this->viewBag[$name] = $value;
	}

	protected function onInit() {}

	public function index() {
		$this->renderView();
	}

	public function renderView($viewName = null, $isPartial = false) {
		if(!$this->viewRendered) {
			if($viewName == null) {
				$viewName = $this->action;
			}

			if(!$isPartial) {
				include_once("views/layouts/" . $this->layout . "/header.php");
			}

			include_once("views/" . $this->controller . "/" . $viewName . ".php");
			if(!$isPartial) {
				include_once("views/layouts/" . $this->layout . "/footer.php");
			}

			$this->viewRendered = true;
		}
	}

	protected function redirectToUrl($url) {
		header("Location: $url");
		die;
	}

	protected function redirect($controller = null, $action = null, $params = array()) {
		if($controller == null) {
			$controller = $this->controller;
		}

		$url = "/$controller/$action";
		$paramsUrlEncoded = array_map("urldecode", $params);
		$paramsJoined = implode('/', $paramsUrlEncoded);
		if($paramsJoined != "") {
			$url .= '/' . $paramsJoined;
		}

		$this->redirectToUrl($url);
	}

	private function addMessage($messageSessionkey, $messageText) {
		if(!isset($_SESSION[$messageSessionkey])) {
			$_SESSION[$messageSessionkey] = array();
		}

		array_push($_SESSION[$messageSessionkey], $messageText);
	}

	protected function addErrorMessage($errorMessage) {
		$this->addMessage(ERROR_MESSAGES_SESSION_KEY, $errorMessage);
	}

	protected function addInfoMessage($infoMessage) {		
		$this->addMessage(INFO_MESSAGES_SESSION_KEY, $infoMessage);
	}

	protected function isLoggedIn() {
		return isset($_SESSION["username"]);
	}

	protected function isAdmin() {
		return isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1;
	}

	protected function authorize() {
		if(!$this->isLoggedIn()) {
			$this->redirect("users", "login");
		}
	}

	protected function authorizeAdmin() {
		if(!$this->isAdmin()) {
			die("Administrator account is required");
		}
	}

	protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
}