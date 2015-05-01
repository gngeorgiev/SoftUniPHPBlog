<?php

class AlbumsController extends BaseController {

    protected function onInit() {
        $this->title = 'Authors';
        $this->albumsModel = new AlbumsModel();
    }

    public function index() {
        $this->authors = $this->albumsModel->getAll();
    }

    public function category($id) {
        $this->categoryAlbums = $this->albumsModel->find($id);
    }

    public function create() {
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->authorsModel->create($name)) {
                $this->addInfoMessage("Author created.");
                $this->redirect("authors");
            } else {
                $this->addErrorMessage("Cannot create author.");
            }
        }
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
