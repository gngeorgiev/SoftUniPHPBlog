<?php

class PostsModel extends BaseModel {
	public function getPostById($id) {
		$statement = self::$db->prepare(
			"SELECT p.id, p.title, p.content, p.date_created, p.visits_count, u.username 
			FROM posts AS p JOIN users AS u ON p.author_id = u.id WHERE p.id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $this->fetch($statement);
		if(count($result) < 1) {
			return null;
		}

		return $result[0];
	}

	public function getRecentPostTitles() {
		$statement = self::$db->prepare("SELECT id, title FROM posts ORDER BY date_created DESC LIMIT 5");
		$statement->execute();
		$result = $this->fetch($statement);
		return $result;
	}

	public function getPopularPostTitles() {
		$statement = self::$db->prepare("SELECT id, title FROM posts ORDER BY visits_count DESC LIMIT 5");
		$statement->execute();
		$result = $this->fetch($statement);
		return $result;
	}

	public function getPostsWithPreview($page, $pageSize = DEFAULT_PAGE_SIZE) {
		$page--;
		$offset = $page * $pageSize;
		$statement = self::$db->prepare(
			"SELECT p.id, p.title, SUBSTRING(content, 1, 500) as preview, p.date_created, p.visits_count, u.username
			FROM posts AS p JOIN users AS u ON p.author_id = u.id 
			ORDER BY date_created DESC LIMIT ?, ?");
		$statement->bind_param("ii", $offset, $pageSize);
		$statement->execute();
		$result = $this->fetch($statement);
		return $result;
	}

	public function getPostsPageCount($pageSize = DEFAULT_PAGE_SIZE) {
		$statement = self::$db->query("SELECT COUNT(id) FROM posts");
        $result = $this->fetch($statement);
        $result = $result[0]["COUNT(id)"];
        return ceil($result / $pageSize);
	}

	public function getSearchPostsWithPreview($searchTerm, $page, $pageSize = DEFAULT_PAGE_SIZE) {
		$page--;
		$offset = $page * $pageSize;
		$searchTerm = "%" . $searchTerm . "%";
		$statement = self::$db->prepare(
			"SELECT p.id, p.title, SUBSTRING(content, 1, 500) as preview, p.date_created, p.visits_count, u.username
			FROM posts AS p JOIN users AS u ON p.author_id = u.id 
			WHERE title LIKE ? OR content LIKE ?
			ORDER BY date_created DESC LIMIT ?, ?");
		$statement->bind_param("ssii", $searchTerm, $searchTerm, $offset, $pageSize);
		$statement->execute();
		$result = $this->fetch($statement);
		return $result;
	}

	public function getSearchPostsPageCount($searchTerm, $pageSize = DEFAULT_PAGE_SIZE) {
		$searchTerm = "%" . $searchTerm . "%";
		$statement = self::$db->prepare(
			"SELECT COUNT(id) FROM posts
			WHERE title LIKE ? OR content LIKE ?");
		$statement->bind_param("ss", $searchTerm, $searchTerm);
		$statement->execute();
        $result = $this->fetch($statement);
        $result = $result[0]["COUNT(id)"];
        return ceil($result / $pageSize);
	}

	public function getPostsWithPreviewByTagId($id, $page, $pageSize = DEFAULT_PAGE_SIZE) {
		$page--;		
		$offset = $page * $pageSize;
		$statement = self::$db->prepare(
			"SELECT p.id, p.title, SUBSTRING(content, 1, 500) as preview, p.date_created, p.visits_count, u.username
			FROM posts AS p JOIN users AS u ON p.author_id = u.id
			JOIN posts_tags AS pt ON p.id = pt.post_id
			WHERE pt.tag_id = ?
			ORDER BY date_created DESC LIMIT ?, ?");
		$statement->bind_param("iii", $id, $offset, $pageSize);
		$statement->execute();
		$result = $this->fetch($statement);
		return $result;
	}

	public function getPostsByTadIdPageCount($id, $pageSize = DEFAULT_PAGE_SIZE) {
		$statement = self::$db->prepare(
			"SELECT COUNT(p.id) FROM posts AS p
			JOIN posts_tags AS pt ON p.id = pt.post_id
			WHERE pt.tag_id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
        $result = $this->fetch($statement);
        $result = $result[0]["COUNT(p.id)"];
        return ceil($result / $pageSize);
	}

	public function increaseViews($id) {
		$statement = self::$db->prepare(
			"UPDATE posts SET visits_count=visits_count + 1 WHERE id=?");
		$statement->bind_param("i", $id);
		$statement->execute();
	}

	public function post($title, $content) {
		if((strlen($title) < TITLE_MIN_LENGTH) || (strlen($title) > TITLE_MAX_LENGTH)) {
			return "Title must be between " . TITLE_MIN_LENGTH .
				" and " . TITLE_MAX_LENGTH . " characters long.";
		}
		if (strlen(trim($content)) == 0) {
			return "Content cannot be empty.";
		}

		$date = $this->getDate();
		$statement = self::$db->prepare("INSERT INTO posts (title, content, date_created, author_id)
			VALUES (?, ?, ?, ?)");
		$statement->bind_param("sssi", $title, $content, $date, $_SESSION["userId"]);
		$statement->execute();

		return null;
	}

	public function edit($id, $title, $content) {
		if((strlen($title) < TITLE_MIN_LENGTH) || (strlen($title) > TITLE_MAX_LENGTH)) {
			return "Title must be between " . TITLE_MIN_LENGTH .
				" and " . TITLE_MAX_LENGTH . " characters long.";
		}

		if (strlen(trim($content)) == 0) {
			return "Content cannot be empty.";
		}

		if(!$this->postExists($id)) {
			return "Post not found.";
		}

		$statement = self::$db->prepare("UPDATE posts
			SET Title=?, Content=?
			WHERE id=?");
		$statement->bind_param("ssi", $title, $content, $id);
		$statement->execute();

		return null;
	}

	public function delete($id) {
		$statement = self::$db->prepare("DELETE FROM posts WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();		
        return $statement->affected_rows > 0;
	}

	public function removeTagFromPost($postId, $tagId) {
		if(!$this->postExists($postId)) {
			return "Post not found.";
		}

		if(!$this->tagExists($tagId)) {
			return "Tag not found.";
		}

		$statement = self::$db->prepare("DELETE FROM posts_tags WHERE post_id = ? AND tag_id = ?");
		$statement->bind_param("ii", $postId, $tagId);
		$statement->execute();	

		return null;
	}

	public function addTagToPost($postId, $tagId) {
		if(!$this->postExists($postId)) {
			return "Post not found.";
		}

		if(!$this->tagExists($tagId)) {
			return "Tag not found.";
		}

		$statement = self::$db->prepare("SELECT COUNT(tag_id) FROM posts_tags WHERE post_id = ? AND tag_id = ?");
		$statement->bind_param("ii", $postId, $tagId);
		$statement->execute();
		$result = $this->fetch($statement);
		if($result[0]["COUNT(id)"] != 0) {
			return "The tag is alredy on the post.";
		}	

		$statement = self::$db->prepare("INSERT INTO posts_tags(post_id, tag_id)
			VALUES (?, ?)");
		$statement->bind_param("ii", $postId, $tagId);
		$statement->execute();

		return null;
	}

	public function postExists($id) {
		$statement = self::$db->prepare("SELECT COUNT(id) FROM posts WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $this->fetch($statement);
		return !($result[0]["COUNT(id)"] == 0);
	}

	public function tagExists($id) {
		$statement = self::$db->prepare("SELECT COUNT(id) FROM tags WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $this->fetch($statement);
		return !($result[0]["COUNT(id)"] == 0);
	}
}

