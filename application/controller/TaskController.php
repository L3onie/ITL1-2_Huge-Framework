<?php

class TaskController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::checkAuthentication();
    }

    // Zeigt das Board (READ)
    public function index()
    {
        $this->View->render('task/index', array(
            'tasks' => TaskModel::getAllTasks()
        ));
    }

    // Seite anzeigen ODER Speichern (CREATE)
    public function create()
    {
        if (Request::post('task_text')) {
            TaskModel::createTask(Request::post('task_text'));
            Redirect::to('task/index');
        } else {
            $this->View->render('task/create');
        }
    }

    // Seite anzeigen ODER Update ausführen (UPDATE)
    public function update($id)
    {
        if (Request::post('task_text')) {
            TaskModel::updateTask(Request::post('task_id'), Request::post('task_text'));
            Redirect::to('task/index');
        } else {
            $this->View->render('task/edit', array(
                'task' => TaskModel::getTask($id)
            ));
        }
    }

    // Task entfernen (DELETE)
    public function delete($id)
    {
        TaskModel::deleteTask($id);
        Redirect::to('task/index');
    }

    // Status-Pfeile (Spezial-Aktion)
    public function updateStatus($id, $new_status)
    {
        TaskModel::updateTaskStatus($id, $new_status);
        Redirect::to('task/index');
    }
}