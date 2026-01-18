<?php

class TaskController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // Sicherheit: Nur eingeloggte User dürfen das Board sehen
        Auth::checkAuthentication();
    }

    // Zeigt das Kanban Board an (READ)
    public function index()
    {
        $this->View->render('task/index', array(
            'tasks' => TaskModel::getAllTasks()
        ));
    }

    // Neuen Task erstellen (CREATE)
    public function create()
    {
        TaskModel::createTask(Request::post('task_text'));
        Redirect::to('task/index');
    }
}