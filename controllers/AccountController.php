<?php

class AccountController extends BaseController {

    protected function onInit() {
        $this->title = 'Account';
        $this->accountModel = new AccountModel();
    }

    public function login() {
    	if($this->isPost()) {
	        $username = $_POST['username'];
	        $password = $_POST['password'];

            $result = $this->accountModel->login($username, $password);

	        if($result) {
	        	$this->addUserToSESSION($username, $result[0]['is_admin']);
	        	$this->redirect('home');
	        } else {
				$this->redirect('account', 'login');
	        }
    	}
    }

    public function register() {
    	if($this->isPost()) {
	        $username = $_POST['username'];
	        $password = $_POST['password'];
	        $hashedPass = password_hash($password, PASSWORD_BCRYPT);

	        if($this->accountModel->register($username, $hashedPass)) {
	        	$this->addUserToSESSION($username, false);
	        	$this->redirect('home');
	        } else {
				$this->redirect('account', 'register');
	        }
    	}
    }

    public function logout() {
    	if($this->isLoggedIn()) {
    		session_destroy();
    		$this->redirect('home');
    	}
    }

    private function addUserToSESSION($username, $isAdmin) {
    	if(!isset($_SESSION)) {
    		session_start();
    	}
        var_dump($isAdmin);
    	$_SESSION['username'] = $username;
    	if($isAdmin) {
    		$_SESSION['isAdmin'] = true;
    	}
    }
}