<?php

namespace app\models;

use yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @var UploadedFile

public $imageFile;
public $imagePath;
public $filePath;
public  $uploadDirectory ;
 * */

class ProductModel extends Model
{
    public $name;
    public $imageFile;
    public $price;
    public $quantity;
    public $description;

    public function rules()
    {
        return [
            [['name', 'price', 'quantity', 'imageFile'], 'required'],
            [['description'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 50],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['price'], 'number'],
            [['quantity'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => "Product's Name",
            'price' => "Product's Price",
            'quantity' => "Product's Quantity",
            'description' => "Product's Description",
        ];
    }
}