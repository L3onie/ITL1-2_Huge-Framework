#  Aufgabe 8: Messenger Dienst

### Datenbank Tabelle erstellen

Als erstes wurde in der Datenbank eine neue Tabelle für messages hinzugefügt mit folgenden Spalten:
| Name   | Data Type |
|---------------|-----------|
| id            | INT(11)         |
| sender_id     | INT(11)         |
| empfaenger_id | INT(11)         |
| message_text  | TEXT            |
| timestamp     | DATETIME        |
| gelesen       | TINYINT(1)      |

### Controller

Dann wurde im Projekt der NoteController kopiert und basierend auf den wurde der der Code für den MessageController geschrieben, worin sich z.B. die index ,show, send zum Anzeigen, und Senden der Nachrichten

z.B. MessageController show():

```
public function show($userId)
    {
        $myId = Session::get('user_id');

        $this->View->render('message/show', [
            'messages' => MessageModel::getConversation($myId, $userId),
            'partnerId' => $userId
        ]);

        // Nachrichten als gelesen markieren
        MessageModel::markAsRead($userId, $myId);
    }

```

### Model

Als nächstes wird das Model von NoteModels kopiert und darauf basierend wieder das MessageModel aufgebaut welches mit der Datenbank kommuniziert und funktionen hat wie sendMessage, getAllConversations, getConversation, countUnreadMessages, markAsRead und hier ein Beispiel vom sendMessage() code:

```
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
```

### View

Es wurde dann noch im View Ordner der message Ordner erstellt in welchen sich die datein für index und show befinden, wo index eine übersicht mit allen Chats von einen User anzeigt und show zeigt den Chatverlauf von einen Chat

hier ein Code Teil von index.php welcher die Tabelle ist in der die ganzen Chats die ein User mit anderen Usern hat angezeigt werden und wenn es keine gibt kommt eine Meldung:

```
<?php if (!empty($this->conversations)) { ?>
            <table class="note-table">
                <thead>
                    <tr>
                        <th>Partner</th>
                        <th>Letzte Nachricht</th>
                        <th>Ungelesen</th>
                        <th>Öffnen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->conversations as $chat): ?>
                        <tr>
                            <td>User #<?= $chat->partner_id ?></td>
                            <td><?= htmlentities($chat->last_message) ?></td>
                            <td>
                                <?php if ($chat->unread_count > 0): ?>
                                    <span class="badge red"><?= $chat->unread_count ?></span>
                                <?php endif; ?>
                            </td>
                            <td><a href="<?= Config::get('URL') . 'message/show/' . $chat->partner_id ?>">Chat öffnen</a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php } else { ?>
            <p>Du hast noch keine Nachrichten.</p>
        <?php } ?>
```

Um alles sehen zu können muss man noch im header noch Messages hinzufügen
```
<li <?php if (View::checkForActiveController($filename, "message")) { echo ' class="active" '; } ?> >
    <a href="<?php echo Config::get('URL'); ?>message/index">Messages</a>
</li>
```

### Andere Änderungen:

In UserModel hatte ich eine funktion für getUserNameById hinzugefügt damit ich im Chat den Usernamen der Person anzeigen kann und nicht das dort nur z.B. User #1 also mit id steht

```
public static function getUserNameById($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT user_name FROM users WHERE user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute([':user_id' => $user_id]);

        $result = $query->fetch();
        return $result ? $result->user_name : null;
    }
```

### Bilder

Chat Liste

![chat liste bild](/_pictures/8Ue_index.png)

***

Chat Verlauf

![chat liste bild](/_pictures/8Ue_Chatverlauf.png)

***

Nachricht schreiben

![nachricht schreiben bild](/_pictures/8Ue_Nachricht_schreiben.png)

***

Nachricht abschicken

![nachricht abschicken bild](/_pictures/8Ue_Nachricht_abgeschickt.png)
