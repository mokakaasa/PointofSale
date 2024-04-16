<?php

namespace app\models;

use yii\db\ActiveRecord;
use \common\traits\base\BeforeQueryTrait;
use \common\traits\SoftDeleteBoolTrait;

class Sales extends ActiveRecord
{
    public static function tableName()
    {
        return 'sales';
    }

    public function rules()
    {
        return [
            [['sales_date', 'quantity', 'expected_price', 'sold_price'], 'required'],
            [['quantity', 'expected_price','sold_price'], 'number'],
            [['sales_date'], 'validateSalesDate'],
            [['product_id'],'safe'],
            [['product_id'], 'exist', 'targetClass' => '\app\models\Product', 'targetAttribute' => 'id'],
        ];
    }

    public function validateSalesDate($attribute, $params)
    {
        try {
            $sales_date = strtotime($this->sales_date);
            $todays_date = strtotime(date('Y-m-d'));

            if ((!$sales_date == $todays_date)) {
                $this->addError($attribute, 'Date the sale was made should be recorded daily.');
            }
        } catch (\Exception $exception) {
            $this->addError($attribute, 'Invalid Format Date');
        }
    }
    public function attributeLabels()
    {
        return [
            'product_id'=>"Sale's Name",
            'sales_date'=>'Date the sale was made',
            'quantity'=>'Quantity which was sold',
            'expected_price'=>'Expected Price',
            'sold_price'=>'Sold Price',
        ];
    }
    public function getProduct()
    {
        return $this->hasOne(Product::class,['id'=>'product_id']);
    }
    public function createSales()
    {
        return $this->save() ;
    }
    public function createNewSales()
    {
        return $this->save() ;
    }

    public function createUpdate()
    {
        $this->quantity;
        $this->sold_price;
        $this->sales_date;
        return $this->save() ;
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