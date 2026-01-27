<?php

class GalleryModel
{
    public static function getUserImages($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM images WHERE user_id = :uid ORDER BY created_at DESC";
        $query = $database->prepare($sql);
        $query->execute([':uid' => $user_id]);
        return $query->fetchAll();
    }

    public static function addImage($user_id, $filename)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "INSERT INTO images (user_id, filename) VALUES (:uid, :fn)";
        $query = $database->prepare($sql);
        return $query->execute([':uid' => $user_id, ':fn' => $filename]);
    }

    public static function getImageById($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM images WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    public static function deleteImage($id, $user_id)
{
    $database = DatabaseFactory::getFactory()->getConnection();
    // Erst das Bild holen, um den Filenamen für das Dateisystem zu haben
    $img = self::getImageById($id);
    if ($img && $img->user_id == $user_id) {
        $sql = "DELETE FROM images WHERE id = :id AND user_id = :uid";
        $query = $database->prepare($sql);
        return $query->execute([':id' => $id, ':uid' => $user_id]);
    }
    return false;
}


    public static function setShareHash($id, $hash)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "UPDATE images SET share_hash = :hash WHERE id = :id";
        $query = $database->prepare($sql);
        return $query->execute([':hash' => $hash, ':id' => $id]);
    }

    public static function getByHash($hash)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM images WHERE share_hash = :hash LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute([':hash' => $hash]);
        return $query->fetch();
    }

}
