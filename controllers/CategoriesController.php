<?php 

class CategoriesController extends BaseController {
	protected function onInit() {
        $this->title = 'Categories';
        $this->categoriesModel = new CategoriesModel();
    }

    public function create() {
    	if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->categoriesModel->create($name)) {
                $this->redirect("home");
            } 
        }
    }
}