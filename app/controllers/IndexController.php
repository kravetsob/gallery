<?php

namespace app\controllers;

use app\core\Route;
use app\core\View;
use app\models\IndexModel;
use app\models\StoreModel;

class IndexController
{
        public IndexModel $indexModel;
        public View $view;
        public StoreModel $storeModel;

        public function __construct()
        {
            $this->indexModel = new IndexModel();
            $this->view = new View();
            $this->storeModel = new StoreModel();
        }

    public function index()
    {
        session_start();

        $photos = $this->indexModel->all();

        $success = $_SESSION['upload_success'] ?? false;
        $errors = $_SESSION['upload_errors'] ?? [];

        unset($_SESSION['upload_success'], $_SESSION['upload_errors']);

        $this->view->render('index', [
            'title' => 'Home',
            'photos' => $photos,
            'success' => $success,
            'errors' => $errors,
        ]);
    }

    public function add()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->storeModel->store($_FILES['photo']);

            if (!$result['success']) {
                $_SESSION['upload_errors'] = $result['errors'];
            } else {
                $this->indexModel->add($result['filename']);
                $_SESSION['upload_success'] = true;
            }

            Route::redirect(Route::url('index', 'index'));
        }

        $photos = $this->indexModel->all();
        $this->view->render('index', [
            'title' => 'Home',
            'photos' => $photos,
        ]);
    }


}