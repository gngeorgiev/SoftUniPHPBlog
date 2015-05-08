<?php

class UsersController extends BaseController {
	private $usersModel;

	protected function onInit() {
		$this->usersModel = new UsersModel();
	}

	public function index() {
		$this->redirect("users", "login");
	}

	public function logout() {
		$this->usersModel->logout();
		$this->redirectToUrl("/");
	}

	public function register() {
		if($this->isLoggedIn()) {
			$this->redirectToUrl("/");
		}

		if($this->isPost()) {
			if(!isset($_POST["requestToken"]) || $_POST["requestToken"] != $_SESSION["requestToken"]) {
				exit;
			}
			
			$this->username = $_POST["username"];
			$this->password = $_POST["password"];
			$this->repeatPassword = $_POST["repeatPassword"];
			$this->email = $_POST["email"];
			$result = $this->usersModel->register($this->username, $this->password, $this->repeatPassword, $this->email);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Registration successful.");
				$this->redirect("users", "login");
			}
		}

		$_SESSION["requestToken"] = hash('sha256', microtime());

		$this->renderView();
	}

	public function login() {
		if($this->isLoggedIn()) {
			$this->redirectToUrl("/");
		}

		if($this->isPost()) {
			if(!isset($_POST["requestToken"]) || $_POST["requestToken"] != $_SESSION["requestToken"]) {
				exit;
			}

			$username = $_POST["username"];
			$password = $_POST["password"];
			$result = $this->usersModel->login($username, $password);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Login successful.");
				$this->redirectToUrl("/");
			}
		}

		$_SESSION["requestToken"] = hash('sha256', microtime());

		$this->renderView();
	}
}