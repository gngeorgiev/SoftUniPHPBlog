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
                $this->addInfoMessage('Successfully Create Category!');
            } else {
                $this->addErrorMessage('Unable to Create Category!');
            }
            $this->redirect("home");
        }
    }
}