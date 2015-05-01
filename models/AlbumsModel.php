<?php

class AlbumsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM albums");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllWithCountryName() {
        $statement = self::$db->query("SELECT a.id, a.name, a.likes, a.dislikes, c.name FROM albums a JOIN categories c ON a.category_id = c.id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM albums WHERE category_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function like($id) {
        $statement = self::$db->prepare(
            "SELECT likes FROM albums WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC)[0]['likes'] + 1;
        $statement = self::$db->prepare(
            "UPDATE albums SET likes = ? WHERE id = ?");
        $statement->bind_param("ii", $result, $id);
        $statement->execute();
    }

    public function dislike($id) {
        $statement = self::$db->prepare(
            "SELECT dislikes FROM albums WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC)[0]['dislikes'] + 1;
        $statement = self::$db->prepare(
            "UPDATE albums SET dislikes = ? WHERE id = ?");
        $statement->bind_param("ii", $result, $id);
        $statement->execute();
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
