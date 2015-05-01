<?php

class AdminModel extends BaseModel {

	public function deleteCategory($id) {
		$statement = self::$db->prepare(
				"DELETE FROM categories WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		return $statement->affected_rows > 0;
	}

	public function deleteAlbum($id) {
		$statement = self::$db->prepare(
				"DELETE FROM albums WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		return $statement->affected_rows > 0;
	}

	public function deletePhoto($id) {
		$statement = self::$db->prepare(
				"DELETE FROM photos WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		return $statement->affected_rows > 0;
	}

	public function deleteComment($id) {
		$statement = self::$db->prepare(
				"DELETE FROM comments WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		return $statement->affected_rows > 0;
	}
}
