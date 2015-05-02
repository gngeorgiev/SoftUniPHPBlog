<?php

class CommentsModel extends BaseModel {

    public function getAll() {
        $statement = self::$db->query(
            "SELECT com.id, com.text, com.username, p.name as photoName, a.name as albumName, c.name as categoryName FROM comments com JOIN photos p ON p.id = com.photo_id JOIN albums a ON p.album_id = a.id JOIN categories c ON a.category_id = c.id ORDER BY com.id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM comments  WHERE id = ? ORDER BY id");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function create($text, $username, $photoId) {
        $statement = self::$db->prepare(
            "INSERT INTO comments VALUES(NULL, ?, ?, ?)");
        $statement->bind_param("ssi", $text, $username, $photoId);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
