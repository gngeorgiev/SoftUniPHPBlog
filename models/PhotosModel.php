<?php

class PhotosModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM photos");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM photos WHERE album_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function create($name, $category) {
        $zero = 0;
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO albums VALUES (NULL, ?, ?, ?, ?)");
        $statement->bind_param("siii", $name, $zero, $zero, $category);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function edit($id, $name) {
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "UPDATE categories SET name = ? WHERE id = ?");
        $statement->bind_param("si", $name, $id);
        $statement->execute();
        return $statement->errno == 0;
    }

    public function delete($id) {
        $statement = self::$db->prepare(
            "DELETE FROM categories WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
