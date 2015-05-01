<?php

class CategoriesModel extends BaseModel {
    
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM categories");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function create($name) {
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO categories VALUES(NULL, ?)");
        $statement->bind_param("s", $name);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
