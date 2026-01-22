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

    $sql = "CALL sp_sendMessage(:sender, :empfaenger, :text)";

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

    $sql = "CALL sp_getAllConversations(:uid)";

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

        $sql = "CALL sp_getConversation(:user_id, :other_id)";

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

    $sql = "CALL sp_countUnreadMessages(:user_id, :partner_id)";

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

        $sql = "CALL sp_markAsRead(:sender_id, :empfaenger_id)";

        $query = $db->prepare($sql);
        $query->execute([
            ':sender_id' => $sender_id,
            ':empfaenger_id' => $empfaenger_id
        ]);

        return $query->rowCount() > 0;
    }
}