<?php

class AlbumsController extends BaseController {

    protected function onInit() {
        $this->title = 'Authors';
        $this->albumsModel = new AlbumsModel();
        $this->categoriesModel = new CategoriesModel();
    }

    public function index() {
        
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
                $this->redirect("home");
            } 
        } else {
            $this->categories = $this->categoriesModel->getAll();
        }
    }

    public function like($albumId, $categoryId) {
        $this->albumsModel->like($albumId);
        $this->redirect('albums', 'category', array($categoryId));
    }

    public function dislike($albumId, $categoryId) {
        $this->albumsModel->dislike($albumId);
        $this->redirect('albums', 'category', array($categoryId));
    }

    public function edit($id) {
        if ($this->isPost()) {
            // Edit the author in the database
            $name = $_POST['name'];
            if ($this->authorsModel->edit($id, $name)) {
                $this->addInfoMessage("Author edited.");
                $this->redirect("authors");
            } else {
                $this->addErrorMessage("Cannot edit author.");
            }
        }

        // Display edit author form
        $this->author = $this->authorsModel->find($id);
        if (!$this->author) {
            $this->addErrorMessage("Invalid author.");
            $this->redirect("authors");
        }
    }

    public function delete($id) {
        if ($this->authorsModel->delete($id)) {
            $this->addInfoMessage("Author deleted.");
        } else {
            $this->addErrorMessage("Cannot delete author #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("authors");
    }
}
