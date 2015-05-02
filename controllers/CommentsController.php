<?php

class CommentsController extends BaseController {

    protected function onInit() {
        $this->title = 'Comments';
        $this->commentsModel = new CommentsModel();
    }

    public function add($photoId) {
    	$text = $_POST['comment-text'];
    	$username = ($this->isLoggedIn()) ? $_SESSION['username'] : 'Anonymous';
    	if($text != '') {
    		if($this->commentsModel->create($text, $username, $photoId)) {
                $this->addInfoMessage('Successfully Create Comment!');
    		} else {
                $this->addErrorMessage('Unable to Create Comment!');
            }
    	} else {
            $this->addErrorMessage('Message is Empty!');
    	}

    	$this->redirect('photos', 'id', array($photoId));
    }
}