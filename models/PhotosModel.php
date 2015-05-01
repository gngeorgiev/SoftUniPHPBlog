<?php

class PhotosModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM photos");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllWithCategoryAndAlbum() {
        $statement = self::$db->query("SELECT p.id, p.name, p.path, c.name as categoryName, a.name as albumName FROM photos p JOIN albums a ON p.album_id = a.id JOIN categories c ON a.category_id = c.id ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function findByAlbum($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM photos WHERE album_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function findById($id) {
        $statement = self::$db->prepare(
            "SELECT p.id, p.name, p.path, a.name as albumName, c.name as categoryName FROM photos p JOIN albums a ON a.id = p.album_id AND p.id = ? JOIN categories c ON c.id = a.category_id");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function photoComments($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM comments WHERE photo_id = ? ORDER BY id");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function create($name, $path, $albumId) {
        $zero = 0;
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO photos VALUES (NULL, ?, ?, ?)");
        $statement->bind_param("ssi", $name, $path, $albumId);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
