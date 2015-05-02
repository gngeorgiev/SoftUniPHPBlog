<?php

class AdminModel extends BaseModel {


	public function getAllUsers() {
		$statement = self::$db->query("SELECT id, username, is_admin FROM users ORDER BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
	}

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

	public function deleteUser($id) {
		$statement = self::$db->prepare(
				"DELETE FROM users WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		return $statement->affected_rows > 0;
	}

	public function makeAdmin($id) {
		$one = 1;
        $statement = self::$db->prepare(
            "UPDATE users SET is_admin = ? WHERE id = ?");
        $statement->bind_param("ii", $one, $id);
        $statement->execute();
        return $statement->errno == 0;
	}

	public function removeAdmin($id) {
		$zero = 0;
        $statement = self::$db->prepare(
            "UPDATE users SET is_admin = ? WHERE id = ?");
        $statement->bind_param("ii", $zero, $id);
        $statement->execute();
        return $statement->errno == 0;
	}
}
