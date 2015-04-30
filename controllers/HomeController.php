<?php

class HomeController extends BaseController {
    protected function onInit() {
        $this->title = 'Welcome';
        $this->categoriesModel = new CategoriesModel();
    }

    public function index() {
        $this->categories = $this->categoriesModel->getAll();
    }
}
