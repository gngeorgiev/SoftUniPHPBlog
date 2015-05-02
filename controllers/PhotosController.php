<?php

class PhotosController extends BaseController {

    protected function onInit() {
        $this->title = 'Photos';
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
                $this->addErrorMessage('There is not photo extension!');
                $this->redirect('photos', 'add');
                return false;
            }
            if($size > 500000) {
                $this->addErrorMessage('Maximum size exceeded!');
                $this->redirect('photos', 'add');
                return false;
            }
            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif'){
                $this->addErrorMessage('Allowded photo types are : jpg, jpeg, png, gif!');
                $this->redirect('photos', 'add');
                return false;
            }
            if (file_exists($file)) {
                $this->addErrorMessage('File already exist!');
                $this->redirect('photos', 'add');
                return false;
            }

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file)) {
                $this->photosModel->create($name, $file, $album);
                $this->addInfoMessage('Successfully Create Photo!');
                $this->redirect('photos', 'album', array($album));
            } else {
                $this->addErrorMessage('Unable to Create Photo!');
                $this->redirect('photos', 'add');
            }

        } else {
            $this->albums = $this->albumsModel->getAll();
        }
    }
}
