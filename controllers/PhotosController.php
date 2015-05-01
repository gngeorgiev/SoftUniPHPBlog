<?php

class PhotosController extends BaseController {

    protected function onInit() {
        $this->title = 'Authors';
        $this->photosModel = new PhotosModel();
        $this->albumsModel = new AlbumsModel();
    }

    public function index() {
        $this->photos = $this->photosModel->getAllWithCategoryAndAlbum();
    }

    public function album($id) {
        $this->albumPhotos = $this->photosModel->findByAlbum($id);
    }

    public function id($id) {
        $this->photo = $this->photosModel->findById($id);
        $this->photoComments = $this->photosModel->photoComments($id);
    }

    public function add() {
        if ($this->isPost()) {
            $extension = pathinfo($_FILES["fileToUpload"]['name'], PATHINFO_EXTENSION);
            $size = $_FILES["fileToUpload"]["size"];
            $name = $_POST['name'];
            $album = $_POST['album'];
            $dir = 'content/photos/';
            $file = $dir . $album . '_' . $name . '.' . $extension;

            if(!$extension){
                $this->redirect('photos', 'add');
                return false;
            }
            if($size > 500000) {
                $this->redirect('photos', 'add');
                return false;
            }
            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif'){
                $this->redirect('photos', 'add');
                return false;
            }
            if (file_exists($file)) {
                $this->redirect('photos', 'add');
                return false;
            }
            var_dump($_FILES["fileToUpload"]["tmp_name"]);
            var_dump($file);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file)) {
                $this->photosModel->create($name, $file, $album);
                $this->redirect('photos', 'album', array($album));
            } else {
                $this->redirect('photos', 'add');
            }

        } else {
            $this->albums = $this->albumsModel->getAll();
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
