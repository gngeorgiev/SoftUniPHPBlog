<?php

class TagsController extends BaseController {
	private $tagsModel;

	protected function onInit() {
		$this->tagsModel = new TagsModel();
	}

	public function index() {
		$this->authorizeAdmin();
		$this->page = 1;
		$this->requestUrl = "/tags";
		if(isset($_GET["page"]) && $_GET["page"] > 1) {
			$this->page = $_GET["page"];
		}

		$this->pagesCount = $this->tagsModel->getTagsPageCount();
		$this->tags = $this->tagsModel->getTags($this->page);
		$this->renderView();
	}

	public function get($id) {
		$this->postId = $id;
		$this->tags = $this->tagsModel->getTagsByPostId($id);
		$this->renderView("tags", true);
	}

	public function getEdit($id) {
		$this->postId = $id;
		$this->tags = $this->tagsModel->getTagsByPostId($id);
		$this->renderView("tagsEdit", true);
	}

	public function getAdd($id) {
		$this->page = 1;
		$this->requestUrl = "/posts/edit/" . $id;
		if(isset($_GET["page"]) && $_GET["page"] > 1) {
			$this->page = $_GET["page"];
		}

		$this->pagesCount = $this->tagsModel->getTagsByPostIdPageCount($id);
		$this->postId = $id;
		$this->tags = $this->tagsModel->getAllTagsNotOnPost($id, $this->page);
		$this->renderView("tagsAdd", true);
	}

	public function create() {
		$this->authorizeAdmin();
		if($this->isPost()) {
			if(!isset($_POST["requestToken"]) || $_POST["requestToken"] != $_SESSION["requestToken"]) {
				exit;
			}
			
			$this->tag = trim($_POST["tag"]);			
			$result = $this->tagsModel->create($this->tag);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Tag created successfully.");
				$this->redirectToUrl("/tags");
			}
		}
		$_SESSION["requestToken"] = hash('sha256', microtime());

		$this->renderView();
	}

	public function delete() {
		$this->authorizeAdmin();
		if($this->isPost()) {
			if(!isset($_POST["requestToken"]) || $_POST["requestToken"] != $_SESSION["requestToken"]) {
				exit;
			}

			$id = $_POST["id"];
			$result = $this->tagsModel->delete($id);
			if($result) {
				$this->addInfoMessage("Tag deleted successfully.");
			}
			else {
				$this->addErrorMessage("Tag not found.");
			}
		}
		$_SESSION["requestToken"] = hash('sha256', microtime());

		$this->redirectToUrl("/tags");
	}

	public function edit($id) {
		$this->authorizeAdmin();
		if(!$this->isPost()) {
			$this->tag = $this->tagsModel->getTagById($id);
			if($this->tag == null) {
				$this->addErrorMessage("Tag not found.");
				$this->redirectToUrl("/tag");
			}
		}
		else {
			if(!isset($_POST["requestToken"]) || $_POST["requestToken"] != $_SESSION["requestToken"]) {
				exit;
			}

			$this->tag = array();
			$this->tag["id"] = $id;
			$this->tag["tag"] = trim($_POST["tag"]);
			$result = $this->tagsModel->edit($id, $this->tag["tag"]);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Tag edited successfully.");
				$this->redirectToUrl("/tags");
			}
		}

		$_SESSION["requestToken"] = hash('sha256', microtime());

		$this->renderView();
	}

	public function popular() {
		$this->tags = $this->tagsModel->getPopularTags();
		$this->renderView("tagsList", true);
	}
}