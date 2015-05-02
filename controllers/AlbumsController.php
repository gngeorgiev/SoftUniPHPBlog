<?php

class AlbumsController extends BaseController {

    protected function onInit() {
        $this->title = 'Albums';
        $this->albumsModel = new AlbumsModel();
        $this->categoriesModel = new CategoriesModel();
    }

    public function index() {
        $this->albums = $this->albumsModel->getAllWithCountryName();
    }

    public function category($id) {
        $this->categoryAlbums = $this->albumsModel->find($id);
        $this->lastCategoryId = $id;
    }

    public function create() {
        if ($this->isPost()) {
            $name = $_POST['name'];
            $category = $_POST['category'];
            if ($this->albumsModel->create($name, $category)) {
                $this->addInfoMessage('Successfully Create Album!');
                $this->redirect('albums', 'category', array($category));
            } else {
                $this->addErrorMessage('Unable to Detele Album!');
            }
        } else {
            $this->categories = $this->categoriesModel->getAll();
        }
    }

    public function like($albumId, $categoryId) {
        if($this->albumsModel->like($albumId)) {
            $this->addInfoMessage('Successfully Liked Album!');
        } else {
            $this->addErrorMessage('Unable to Liked Album!');   
        }
        if($categoryId) {
            $this->redirect('albums', 'category', array($categoryId));
        } else {
            $this->redirect('albums');
        }
    }

    public function dislike($albumId, $categoryId) {
        if($this->albumsModel->dislike($albumId)) {
            $this->addInfoMessage('Successfully Dislike Album!');
        } else {
            $this->addErrorMessage('Unable to Dislike Album!');   
        }

        $this->redirect('albums', 'category', array($categoryId));
    }
}
