<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Product;

class Images extends Model
{

    /**
     * @var UploadedFile
     */

    public $imageFile;

    public static function tableName()
    {
        return 'product';
    }


    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg','on'=>'upload,view,update'],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class);
    }


    public function upload()
    {
        if ($this->imageFile) {
            $this->imageFile->saveAs('/../uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return $this->save();
        }
    }
}