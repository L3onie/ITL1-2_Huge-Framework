<?php

/**
 * MessageModel
 * Einfache Nachrichten-Funktionen (senden, abrufen, zählen, lesen markieren)
 */
class MessageModel
{
    /**
     * Nachricht senden
     * @param int $empfaenger_id ID des Empfängers
     * @param string $text Inhalt der Nachricht
     * @return bool Erfolg oder Fehler
     */ 
    public static function sendMessage($senderId, $empfaengerId, $text)
{
    if (!$senderId || !$empfaengerId || empty($text)) {
        return false;
    }

    $db = DatabaseFactory::getFactory()->getConnection();

    $sql = "INSERT INTO messages (sender_id, empfaenger_id, message_text)
            VALUES (:sender, :empfaenger, :text)";

    $query = $db->prepare($sql);
    $query->execute([
        ':sender' => $senderId,
        ':empfaenger' => $empfaengerId,
        ':text' => $text
    ]);

    return $query->rowCount() === 1;
}


    public static function getAllConversations($userId)
{
    $db = DatabaseFactory::getFactory()->getConnection();

    $sql = "
        SELECT 
            IF(sender_id = :uid, empfaenger_id, sender_id) AS partner_id,
            MAX(timestamp) AS last_message_time,
            SUBSTRING_INDEX(GROUP_CONCAT(message_text ORDER BY timestamp DESC), ',', 1) AS last_message
        FROM messages
        WHERE sender_id = :uid OR empfaenger_id = :uid
        GROUP BY partner_id
        ORDER BY last_message_time DESC
    ";

    $query = $db->prepare($sql);
    $query->execute([':uid' => $userId]);

    $conversations = $query->fetchAll();

    // Ungelesene Nachrichten pro Partner hinzufügen
    foreach ($conversations as &$chat) {
        $chat->unread_count = self::countUnreadMessages($chat->partner_id);
    }

    return $conversations;
}


    /**
     * Alle Nachrichten zwischen aktuellem User und anderem User abrufen
     * @param int $otherUserId ID des anderen Users
     * @return array alle Nachrichten
     */
    public static function getConversation($userId, $otherUserId)
    {
        $userId = Session::get('user_id');
        $db = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT *
                FROM messages
                WHERE (sender_id = :user_id AND empfaenger_id = :other_id)
                   OR (sender_id = :other_id AND empfaenger_id = :user_id)
                ORDER BY timestamp ASC";

        $query = $db->prepare($sql);
        $query->execute([
            ':user_id' => $userId,
            ':other_id' => $otherUserId
        ]);

        return $query->fetchAll();
    }

    /**
     * Anzahl ungelesener Nachrichten des aktuellen Users
     * @return int Anzahl ungelesener Nachrichten
     */
    public static function countUnreadMessages($partnerId)
{
    $userId = Session::get('user_id');
    $db = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT COUNT(*) AS amount
            FROM messages
            WHERE empfaenger_id = :user_id
              AND sender_id = :partner_id
              AND gelesen = 0";

    $query = $db->prepare($sql);
    $query->execute([
        ':user_id' => $userId,
        ':partner_id' => $partnerId
    ]);

    return (int) $query->fetch()->amount;
}


    /**
     * Nachrichten von bestimmtem Sender als gelesen markieren
     * @param int $sender_id ID des Absenders
     * @return bool Erfolg oder Fehler
     */
    public static function markAsRead($sender_id, $empfaenger_id)
    {
        $empfaenger_id = Session::get('user_id');
        $db = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE messages
                SET gelesen = 1
                WHERE sender_id = :sender_id
                  AND empfaenger_id = :empfaenger_id";

        $query = $db->prepare($sql);
        $query->execute([
            ':sender_id' => $sender_id,
            ':empfaenger_id' => $empfaenger_id
        ]);

        return $query->rowCount() > 0;
    }
}