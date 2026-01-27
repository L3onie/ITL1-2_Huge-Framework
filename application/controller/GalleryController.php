<?php

class GalleryController extends Controller
{
    public function index()
    {
        Auth::checkAuthentication();
        $user_id = Session::get('user_id');
        $images = GalleryModel::getUserImages($user_id);

        $this->View->render('gallery/index', [
            'images' => $images
        ]);
    }

    public function upload()
    {
        Auth::checkAuthentication();
        $user_id = Session::get('user_id');

        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            Redirect::to('gallery');
            return;
        }

        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $newName = uniqid() . '.' . $ext;

        $targetDir = realpath(__DIR__ . '/../../uploads/userpictures') . '/' . $user_id . '/';
        if (!is_dir($targetDir))
            mkdir($targetDir, 0770, true);

        move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $newName);
        GalleryModel::addImage($user_id, $newName);

        Redirect::to('gallery');
    }

    public function show($id)
    {
        Auth::checkAuthentication();
        $user_id = Session::get('user_id');
        $img = GalleryModel::getImageById($id);

        if (!$img || $img->user_id != $user_id)
            die("Kein Zugriff");

        $path = realpath(__DIR__ . '/../../uploads/userpictures') . '/' . $user_id . '/' . $img->filename;
        $mime = mime_content_type($path);
        header("Content-Type: $mime");
        readfile($path);
    }

    public function view($id)
    {
        Auth::checkAuthentication();
        $user_id = Session::get('user_id');
        $img = GalleryModel::getImageById($id);

        if (!$img || $img->user_id != $user_id) {
            die("Kein Zugriff");
        }

        $this->View->render('gallery/view', ['img' => $img]);
    }
    public function download($id)
    {
        Auth::checkAuthentication();
        $user_id = Session::get('user_id');
        $img = GalleryModel::getImageById($id);

        if ($img && $img->user_id == $user_id) {
            $path = realpath(__DIR__ . '/../../uploads/userpictures') . '/' . $user_id . '/' . $img->filename;
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($path) . '"');
            readfile($path);
            exit;
        }
    }

    public function delete($id)
    {
        Auth::checkAuthentication();
        $user_id = Session::get('user_id');
        $img = GalleryModel::getImageById($id);

        if ($img && $img->user_id == $user_id) {
            $path = realpath(__DIR__ . '/../../uploads/userpictures') . '/' . $user_id . '/' . $img->filename;
            if (is_file($path))
                unlink($path);
            GalleryModel::deleteImage($id, $user_id);
        }

        Redirect::to('gallery');
    }

    public function share($id)
    {
        Auth::checkAuthentication();
        $img = GalleryModel::getImageById($id);

        if (!$img || $img->user_id != Session::get('user_id')) {
            http_response_code(403);
            echo json_encode(['error' => 'Kein Zugriff']);
            exit;
        }

        $hash = bin2hex(random_bytes(16));
        GalleryModel::setShareHash($id, $hash);

        $link = Config::get('URL') . "gallery/publicview/" . $hash;

        header('Content-Type: application/json');
        echo $link;
        exit;
    }

    public function publicview($hash)
    {
        $img = GalleryModel::getByHash($hash);
        if (!$img)
            die("Ungültiger Link");

        $path = realpath(__DIR__ . '/../../uploads/userpictures') . '/' . $img->user_id . '/' . $img->filename;
        if (!is_file($path))
            die("Datei nicht gefunden");

        $mime = mime_content_type($path);
        header("Content-Type: $mime");
        readfile($path);
    }
}