<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/5
 * Time: 16:11
 */

namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;
class UploadForm extends Model
{
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}