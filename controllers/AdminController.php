<?php

class AdminController extends BaseController {

    protected function onInit() {
    	$this->authorizeAdmin();
        $this->title = 'ADMIN';
        $this->adminModel = new adminModel();
        $this->categoriesModel = new CategoriesModel();
        $this->albumsModel = new AlbumsModel();
        $this->photosModel = new PhotosModel();
        $this->commentsModel = new CommentsModel();
    }

	public function categories() {	
		$this->categories = $this->categoriesModel->getAll();
	}

	public function albums() {
		$this->albums = $this->albumsModel->getAllWithCountryName();
	}

	public function photos() {
		$this->photos = $this->photosModel->getAllWithCategoryAndAlbum();
	}

	public function comments() {
		$this->comments = $this->commentsModel->getAll();
	}

	public function users() {
		$this->users = $this->adminModel->getAllUsers();
	}

	public function editCategory($id) {	
		
	}

	public function editAlbum($id) {

	}

	public function editPhoto($id) {

	}

	public function editComment($id) {

	}


	public function deleteCategory($id) {
		if($this->adminModel->deleteCategory($id)) {
			$this->redirect('admin', 'categories');
		}
	}

	public function deleteAlbum($id) {
		if($this->adminModel->deleteAlbum($id)) {
			$this->redirect('admin', 'albums');
		}
	}

	public function deletePhoto($id) {
		$photo = $this->photosModel->findById($id);
		if($this->adminModel->deletePhoto($id)) {
			if(file_exists($photo[0]['path'])) {
				unlink($photo[0]['path']);
				$this->redirect('admin', 'photos');
			}
		}
	}

	public function deleteComment($id) {
		if($this->adminModel->deleteComment($id)) {
			$this->redirect('admin', 'comments');
		}
	}

	public function deleteUser($id) {
		if($this->adminModel->deleteUser($id)) {
			$this->redirect('admin', 'users');
		}
	}


	public function makeAdmin($id) {
		if($this->adminModel->makeAdmin($id)) {
			$this->redirect('admin', 'users');
		}
	}

	public function removeAdmin($id) {
		if($this->adminModel->removeAdmin($id)) {
			$this->redirect('admin', 'users');
		}
	}
}