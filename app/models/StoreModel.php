<?php

namespace app\models;

use app\validators\ImageValidator;

class StoreModel
{
    /**
     * @var ImageValidator
     */
    protected ImageValidator $imageValidator;

    /**
     * storeModel constuctor
     */
    public function __construct()
    {
        $this->imageValidator = new ImageValidator();
    }
    protected function checkDir()
    {
        if(!is_dir(PHOTO_UPLOAD_DIR)){
            mkdir(PHOTO_UPLOAD_DIR, 0777, true);
        }
    }

    /**
     * Uploads an image file to the server and saves its name to the database
     * @param array $file
     * @return string
     */
    public function store(array $file): array
    {
        $errors = $this->imageValidator->validate($file);

        //у разі помилки
        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        $newName = uniqid() . '_' . basename($file['name']);
        $destination = PHOTO_UPLOAD_DIR . DIRECTORY_SEPARATOR . $newName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return [
                'success' => false,
                'errors' => ['Не вдалося зберегти файл.'],
            ];
        }

        //у разі успішного завантаження
        return [
            'success' => true,
            'filename' => $newName,
        ];
    }
}