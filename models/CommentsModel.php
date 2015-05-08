<?php

class CommentsModel extends BaseModel {
	public function getCommentsByPostId($id, $page, $pageSize = DEFAULT_PAGE_SIZE) {
		$page--;
		$offset = $page * $pageSize;
		$statement = self::$db->prepare(
			"(SELECT c.id, c.content, c.date_created, u.username, 1 as type
			FROM user_comments AS c 
			JOIN users AS u ON c.author_id = u.id 
			WHERE c.post_id = ?)
			UNION ALL
			(SELECT id, content, date_created, username, 0 as type
			 FROM guest_comments 
			 WHERE post_id = ?)			
			ORDER BY date_created DESC LIMIT ?, ?");
		$statement->bind_param("iiii", $id, $id, $offset, $pageSize);
		$statement->execute();
		$result = $this->fetch($statement);
		return $result;
	}

	public function getCommentsByPostIdPageCount($id, $pageSize = DEFAULT_PAGE_SIZE) {
		$statement = self::$db->prepare(
			"SELECT COUNT(a.id) FROM
			((SELECT c.id
			FROM user_comments AS c 
			WHERE c.post_id = ?)
			UNION ALL
			(SELECT id
			 FROM guest_comments 
			 WHERE post_id = ?)) a");
		$statement->bind_param("ii", $id, $id);
		$statement->execute();
        $result = $this->fetch($statement);
        $result = $result[0]["COUNT(a.id)"];
        return ceil($result / $pageSize);
	}

	public function getAllComments($page, $pageSize = DEFAULT_PAGE_SIZE) {
		$page--;
		$offset = $page * $pageSize;
		$statement = self::$db->prepare(
			"(SELECT c.id, c.content, c.date_created, u.username, 1 as type
			FROM user_comments AS c 
			JOIN users AS u ON c.author_id = u.id )
			UNION ALL
			(SELECT id, content, date_created, username, 0 as type
			 FROM guest_comments )			
			ORDER BY date_created DESC LIMIT ?, ?");
		$statement->bind_param("ii", $offset, $pageSize);
		$statement->execute();
		$result = $this->fetch($statement);
		return $result;
	}

	public function getAllCommentsPageCount($pageSize = DEFAULT_PAGE_SIZE) {
		$statement = self::$db->query("SELECT COUNT(a.id) FROM 
			((SELECT c.id FROM user_comments c)
			UNION ALL
			(SELECT t.id FROM guest_comments t)) a");
        $result = $this->fetch($statement);
        $result = $result[0]["COUNT(a.id)"];
        return ceil($result / $pageSize);
	}

	public function postGuestComment($id, $name, $email, $content) {
		$postValidationError = $this->validatePostId($id);
		if($postValidationError != null) {
			return $postValidationError;
		}

		$contentValidationError = $this->validateContent($content);
		if($contentValidationError != null) {
			return $contentValidationError;
		}

		$usernameValidationError = $this->validateUserName($name);
		if($usernameValidationError != null) {
			return $usernameValidationError;
		}

		$emailValidationError = $this->validateEmail($email);
		if($emailValidationError != NULL) {
			return $emailValidationError;
		}

		$date = $this->getDate();

		$statement = self::$db->prepare(
			"INSERT INTO guest_comments (content, date_created, username, email, post_id)
			VALUES (?, ?, ?, ?, ?)");
		$statement->bind_param("ssssi", $content, $date, $name, $email, $id);
		$statement->execute();

		return null;
	}

	public function postUserComment($id, $content) {
		$postValidationError = $this->validatePostId($id);
		if($postValidationError != null) {
			return $postValidationError;
		}

		$contentValidationError = $this->validateContent($content);
		if($contentValidationError != null) {
			return $contentValidationError;
		}

		$date = $this->getDate();
		$statement = self::$db->prepare(
			"INSERT INTO user_comments (content, date_created, author_id, post_id)
			VALUES (?, ?, ?, ?)");
		$statement->bind_param("ssii", $content, $date, $_SESSION["userId"], $id);
		$statement->execute();

		return null;
	}

	public function getUserCommentById($id) {
		$statement = self::$db->prepare(
			"SELECT id, content 
			FROM user_comments WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $this->fetch($statement);
		if(count($result) < 1) {
			return null;
		}

		return $result[0];
	}

	public function getGuestCommentById($id) {
		$statement = self::$db->prepare(
			"SELECT id, username, email, content
			FROM guest_comments WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $this->fetch($statement);
		if(count($result) < 1) {
			return null;
		}

		return $result[0];
	}

	public function editUserComment($id, $content) {
		$contentValidationError = $this->validateContent($content);
		if($contentValidationError != null) {
			return $contentValidationError;
		}

		$statement = self::$db->prepare("SELECT COUNT(id) FROM user_comments WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();		
		$result = $this->fetch($statement);
		if($result[0]["COUNT(id)"] == 0) {
			return "Comment not found.";
		}

		$statement = self::$db->prepare("UPDATE user_comments SET content = ? WHERE id = ?");
		$statement->bind_param("si", $content, $id);
		$statement->execute();

		return null;
	}


	public function editGuestComment($id, $username, $email, $content) {
		$contentValidationError = $this->validateContent($content);
		if($contentValidationError != null) {
			return $contentValidationError;
		}

		$usernameValidationError = $this->validateUserName($username);
		if($usernameValidationError != null) {
			return $usernameValidationError;
		}

		$emailValidationError = $this->validateEmail($email);
		if($emailValidationError != NULL) {
			return $emailValidationError;
		}

		$statement = self::$db->prepare("SELECT COUNT(id) FROM guest_comments WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();		
		$result = $this->fetch($statement);
		if($result[0]["COUNT(id)"] == 0) {
			return "Comment not found.";
		}

		$statement = self::$db->prepare("UPDATE guest_comments
			SET username = ?, email = ?, content = ? 
			WHERE id = ?");
		$statement->bind_param("sssi", $username, $email, $content, $id);
		$statement->execute();

		return null;
	}

	public function deleteUserComment($id) {
		$statement = self::$db->prepare("DELETE FROM user_comments WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();		
        return $statement->affected_rows > 0;
	}

	public function deleteGuestComment($id) {
		$statement = self::$db->prepare("DELETE FROM guest_comments WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();		
        return $statement->affected_rows > 0;
	}

	private function validatePostId($id) {
		$statement = self::$db->prepare("SELECT COUNT(id) FROM posts WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $this->fetch($statement);
		if($result[0]["COUNT(id)"] == 0) {
			return "Post not found.";
		}

		return null;
	}

	private function validateContent($content) {
		if((strlen($content) < COMMENT_MIN_LENGTH) || (strlen($content) > COMMENT_MAX_LENGTH)) {
			return "Comment must be between " . COMMENT_MIN_LENGTH .
				" and " . COMMENT_MAX_LENGTH . " characters long.";
		}

		return null;
	}

	private function validateUserName($username) {
		if((strlen($username) < USERNAME_MIN_LENGTH) || (strlen($username) > USERNAME_MAX_LENGTH)) {
			return "Username must be between " . USERNAME_MIN_LENGTH .
				" and " . USERNAME_MAX_LENGTH . " characters long.";
		}

		if(preg_match('/[^\w]/', $username)) {
			return "Username can only contain letters, numbers and \"_\".";
		}

		return null;
	}

	private function validateEmail($email) {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) && $email != null) {
			return "The chosen email is invalid.";
		}

		return null;
	}
}