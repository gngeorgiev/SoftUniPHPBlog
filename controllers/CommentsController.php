<?php

class CommentsController extends BaseController{
	private $commentsModel;

	protected function onInit() {
		$this->commentsModel = new CommentsModel();
	}

	public function get($id) {
		$this->page = 1;
		$this->requestUrl = "/posts/view/" . $id;
		if(isset($_GET["page"]) && $_GET["page"] > 1) {
			$this->page = $_GET["page"];
		}

		$this->returnUrl = "/posts/view/" . $id; 
		$this->pagesCount = $this->commentsModel->getCommentsByPostIdPageCount($id);
		$this->comments = $this->commentsModel->getCommentsByPostId($id, $this->page);
		$this->renderView("comments", true);
	}

	public function index() {
		$this->page = 1;
		$this->requestUrl = "/comments";
		if(isset($_GET["page"]) && $_GET["page"] > 1) {
			$this->page = $_GET["page"];
		}

		$this->returnUrl="/comments"; 
		$this->pagesCount = $this->commentsModel->getAllCommentsPageCount();
		$this->comments = $this->commentsModel->getAllComments($this->page);
		$this->renderView("comments");
	}

	public function post($id){
		if($this->isPost()) { 
			if(!isset($_POST["requestToken"]) || $_POST["requestToken"] != $_SESSION["requestToken"]) {
				exit;
			}

			$commentText = $_POST["comment_text"];
			if($this->isLoggedIn()) {	
				$result = $this->commentsModel->postUserComment($id, $commentText);
			}
			else {
				$name = $_POST["guest_name"];
				$email = $_POST["guest_email"];	
				$result = $this->commentsModel->postGuestComment($id, $name, $email, $commentText);
			}
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Comment posted successfully.");
			}

			$this->redirect("posts", "view", array($id));
		}
		$_SESSION["requestToken"] = hash('sha256', microtime());

		$this->renderView("post", true);
	}

	public function editUserComment($id) {
		$this->authorizeAdmin();
		if(!$this->isPost()) {
			$this->comment = $this->commentsModel->getUserCommentById($id);
			if($this->comment == null) {
				$this->addErrorMessage("Comment not found.");
				$this->redirectToUrl("/comments");
			}
		}
		else {
			if(!isset($_POST["requestToken"]) || $_POST["requestToken"] != $_SESSION["requestToken"]) {
				exit;
			}

			$this->comment = array();
			$this->comment["id"] = $id;		
			$this->comment["content"] = trim($_POST["content"]);
			$result = $this->commentsModel->editUserComment($id, $this->comment["content"]);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Comment edited successfully.");
				$this->redirectToUrl("/comments");
			}
		}
		$_SESSION["requestToken"] = hash('sha256', microtime());

		$this->renderView();
	}
	
	public function deleteUserComment() {
		$this->authorizeAdmin();
		if($this->isPost()) {
			if(!isset($_POST["requestToken"]) || $_POST["requestToken"] != $_SESSION["requestToken"]) {
				exit;
			}

			$id = $_POST["id"];
			$result = $this->commentsModel->deleteUserComment($id);
			if($result) {
				$this->addInfoMessage("Comment deleted successfully.");
			}
			else {
				$this->addErrorMessage("Comment not found.");
			}
		}
		$_SESSION["requestToken"] = hash('sha256', microtime());
		$returnUrl = "/comments";
		if(isset($_POST["returnUrl"])) {
			$returnUrl = $_POST["returnUrl"];
		}

		$this->redirectToUrl($returnUrl);
	}

	public function editGuestComment($id) {
		$this->authorizeAdmin();
		if(!$this->isPost()) {
			$this->comment = $this->commentsModel->getGuestCommentById($id);
			if($this->comment == null) {
				$this->addErrorMessage("Comment not found.");
				$this->redirectToUrl("/comments");
			}
		}
		else {
			if(!isset($_POST["requestToken"]) || $_POST["requestToken"] != $_SESSION["requestToken"]) {
				exit;
			}
			
			$this->comment = array();
			$this->comment["id"] = $id;
			$this->comment["username"] = trim($_POST["username"]);			
			$this->comment["email"] = trim($_POST["email"]);
			$this->comment["content"] = trim($_POST["content"]);
			$result = $this->commentsModel->editGuestComment($id, $this->comment["username"], $this->comment["email"], $this->comment["content"]);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Comment edited successfully.");
				$this->redirectToUrl("/comments");
			}
		}
		$_SESSION["requestToken"] = hash('sha256', microtime());

		$this->renderView();
	}

	public function deleteGuestComment($id) {
		$this->authorizeAdmin();
		if($this->isPost()) {
			if(!isset($_POST["requestToken"]) || $_POST["requestToken"] != $_SESSION["requestToken"]) {
				exit;
			}

			$id = $_POST["id"];
			$result = $this->commentsModel->deleteGuestComment($id);
			if($result) {
				$this->addInfoMessage("Comment deleted successfully.");
			}
			else {
				$this->addErrorMessage("Comment not found.");
			}
		}
		$_SESSION["requestToken"] = hash('sha256', microtime());
		$returnUrl = "/comments";
		if(isset($_POST["returnUrl"])) {
			$returnUrl = $_POST["returnUrl"];
		}

		$this->redirectToUrl($returnUrl);
	}
}