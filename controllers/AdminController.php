<?php

class AdminController extends BaseController {

    protected function onInit() {
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
}