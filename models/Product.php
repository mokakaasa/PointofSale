<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use \common\traits\base\BeforeQueryTrait;
use \common\traits\SoftDeleteBoolTrait;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            [['name', 'price', 'quantity', 'imagePath'], 'required'],
            [['description'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 50],
            [['imagePath'], 'string', 'max' => 200, 'skipOnEmpty' => false],
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
    public function getSales()
    {
        return $this->hasMany(Sales::class, ['product_id' => 'id']);
    }

    public function createProduct()
    {

        return $this->save();
    }

    public function createNewProduct(ProductModel $productModel)
    {
        if ($productModel->validate()) {
            $imageFile = $productModel->imageFile;
            $uploadDirectory = Yii::getAlias('@webroot/uploads');
            // Create the 'uploads' directory if it doesn't exist
            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true);
            }
            $filePath = $uploadDirectory . '/' . $imageFile->baseName . '.' . $imageFile->extension;
            $path='/uploads/'.$imageFile->baseName . '.' . $imageFile->extension;
            if ($imageFile->saveAs($filePath)) {
                $this->name = $productModel->name;
                $this->price = $productModel->price;
                $this->quantity = $productModel->quantity;
                $this->description = $productModel->description;
                $this->imagePath = $path;
                return $this->save();
            }
        }

        return false;
    }


    public function createUpdate()
    {
        $this->price;
        $this->quantity ;
        return $this->save();
    }

    public function createsoftDelete()
    {
        $this->is_deleted = 1;
        return  $this->save(false);
    }
    public function createreverse()
    {
        $this->is_deleted=0;
        return $this->save(false);
    }
}