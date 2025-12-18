<?php

/**
 * The Message controller: Just an example of simple create, read, update and delete (CRUD) actions.
 */
class MessageController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // VERY IMPORTANT: All controllers/areas that should only be usable by logged-in users
        // need this line! Otherwise not-logged in users could do actions. If all of your pages should only
        // be usable by logged-in users: Put this line into libs/Controller->__construct
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /Message/index in your app.
     * Gets all Messages (of the user).
     */
    public function index()
    {
        $this->View->render('message/index', [
            'conversations' => MessageModel::getAllConversations(Session::get('user_id'))
        ]);
    }


    // Gespräch anzeigen
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

    // Nachricht senden
    public function send()
{
    $receiver_id = $_POST['receiver_id'] ?? $_GET['receiver_id'] ?? null;
    $message_text = $_POST['message_text'] ?? $_GET['message_text'] ?? null;

    if (!$receiver_id || !$message_text) {
        Session::add('feedback_negative', 'Ungültige Anfrage (Empfänger oder Text fehlt).');
        Redirect::to('message');
        return;
    }

    $success = MessageModel::sendMessage(
        Session::get('user_id'),
        $receiver_id,
        $message_text
    );

    if ($success) {
        Session::add('feedback_positive', 'Nachricht erfolgreich gesendet.');
    } else {
        Session::add('feedback_negative', 'Nachricht konnte nicht gesendet werden.');
    }

    Redirect::to('message/show/' . $receiver_id);
}


}
