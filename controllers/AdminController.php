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
		$this->editCategory = $this->categoriesModel->getById($id);
		if($this->isPost()) {
			$name = $_POST['categoryName'];
			if($this->adminModel->editCategory($name, $id)) {
				$this->addInfoMessage('Successfully Edited Category : ' . $this->editCategory[0]['name']);
				$this->redirect('admin','categories');
			} else {
				$this->addErrorMessage('Unable to Edited Category : ' . $this->editCategory[0]['name']);
				$this->redirect('admin','editCategory', array($id));
			}
		}
	}

	public function editAlbum($id) {
		$this->editAlbum = $this->albumsModel->find($id);
		if($this->isPost()) {
			$name = $_POST['albumName'];
			$likes = $_POST['likes'];
			$dislikes = $_POST['dislikes'];
			if($this->adminModel->editAlbum($name, $likes, $dislikes, $id)) {
				$this->addInfoMessage('Successfully Edited Album : ' . $this->editAlbum[0]['name']);
				$this->redirect('admin','albums');
			} else {
				$this->addErrorMessage('Unable to Edited Album : ' . $this->editAlbum[0]['name']);
				$this->redirect('admin','editAlbum', array($id));
			}
		}
	}

	public function editPhoto($id) {
		$this->editPhoto = $this->photosModel->findById($id);
		if($this->isPost()) {
			$name = $_POST['photoName'];
			if($this->adminModel->editPhoto($name, $id)) {
				$this->addInfoMessage('Successfully Edited Photo : ' . $this->editPhoto[0]['name']);				
				$this->redirect('admin','photos');
			} else {
				$this->addErrorMessage('Unable to Edited Photo : ' . $this->editPhoto[0]['name']);
				$this->redirect('admin','editPhoto', array($id));				
			}
		}
	}

	public function editComment($id) {
		$this->editComment = $this->commentsModel->find($id);
		if($this->isPost()) {
			$name = $_POST['photoName'];
			if($this->adminModel->editPhoto($name, $id)) {
				$this->redirect('admin','photos');
			}
		}
	}

	public function editUser($id) {
		if($this->isPost()) {
			// TODO
		}
	}

	public function deleteCategory($id) {
		if($this->adminModel->deleteCategory($id)) {
			$this->addInfoMessage('Successfully Detele Category!');
		} else {
			$this->addErrorMessage('Unable to Detele Category!');			
		}
		$this->redirect('admin', 'categories');
	}

	public function deleteAlbum($id) {
		if($this->adminModel->deleteAlbum($id)) {
			$this->addInfoMessage('Successfully Detele Album!');			
		} else {
			$this->addErrorMessage('Unable to Detele Album!');	
		}
		$this->redirect('admin', 'albums');
	}

	public function deletePhoto($id) {
		$photo = $this->photosModel->findById($id);
		if($this->adminModel->deletePhoto($id)) {
			if(file_exists($photo[0]['path'])) {
				unlink($photo[0]['path']);
				$this->addInfoMessage('Successfully Detele Photo!');
				$this->redirect('admin', 'photos');
			} else {
				$this->addErrorMessage('Unable to Detele Photo!');
				$this->redirect('admin', 'photos');
			}
		} else {
			$this->addErrorMessage('Unable to Detele Photo!');
			$this->redirect('admin', 'photos');
		}
	}

	public function deleteComment($id) {
		if($this->adminModel->deleteComment($id)) {
			$this->addInfoMessage('Successfully Detele Comment!');			
		} else {
			$this->addErrorMessage('Unable to Detele Comment!');
		}

		$this->redirect('admin', 'comments');
	}

	public function deleteUser($id) {
		if($this->adminModel->deleteUser($id)) {
			$this->addInfoMessage('Successfully Detele User!');
		} else {
			$this->addErrorMessage('Unable to Detele User!');
		}

		$this->redirect('admin', 'users');
	}


	public function makeAdmin($id) {
		if($this->adminModel->makeAdmin($id)) {
			$this->addInfoMessage('Successfully Make User Admin!');
		} else {
			$this->addErrorMessage('Unable to Make User Admin!');
		}

		$this->redirect('admin', 'users');
	}

	public function removeAdmin($id) {
		if($this->adminModel->removeAdmin($id)) {
			$this->addInfoMessage('Successfully Remove User Admin!');
		} else {
			$this->addErrorMessage('Unable to Remove User Admin!');
		}

		$this->redirect('admin', 'users');
	}
}