<?php

class TaskModel
{
    // Alle Tasks des Users holen
    public static function getAllTasks()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT id, text, status FROM tasks WHERE user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        return $query->fetchAll();
    }

    // Neuen Task anlegen
    public static function createTask($text)
    {
        if (!$text || strlen($text) == 0) {
            Session::add('feedback_negative', 'Task Text darf nicht leer sein.');
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO tasks (text, user_id) VALUES (:text, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':text' => $text, ':user_id' => Session::get('user_id')));

        return ($query->rowCount() == 1);
    }

    // Status ändern (Verschieben im Kanban)
    public static function updateTaskStatus($id, $new_status)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE tasks SET status = :status WHERE id = :id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(
            ':status' => $new_status, 
            ':id' => $id, 
            ':user_id' => Session::get('user_id')
        ));

        return ($query->rowCount() == 1);
    }

    // Task löschen
    public static function deleteTask($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':user_id' => Session::get('user_id')));

        return ($query->rowCount() == 1);
    }
}