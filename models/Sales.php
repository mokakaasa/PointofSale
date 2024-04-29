<?php

namespace app\models;


use app\models\Product;
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
            [['sales_date', 'quantity', 'sold_price','total_amount', 'product_id'], 'required'],
            [['quantity', 'expected_price','sold_price','total_amount','expected_amount'], 'number',],
            [['sales_date'], 'validateSalesDate'],
            [['total_amount'], 'validateExpectedAmount'],
            [['product_id'],'safe'],
            [['product_id'], 'exist', 'targetClass' => '\app\models\Product', 'targetAttribute' => 'id'],
        ];
    }



    public function validateSalesDate($attribute, $params)
    {
        try {

            $sales_date = strtotime(date('Y-m-d', strtotime($this->sales_date)));
            $todays_date = strtotime(date('Y-m-d'));

            if (($sales_date !== $todays_date)) {
                $this->addError($attribute, 'Date the sale was made should be recorded daily.');
            }

        } catch (\Exception $exception) {
            $this->addError($attribute, 'Invalid Format Date');
        }
    }

    public function validateExpectedAmount($attribute, $params)
    {
        $product = Product::findOne($this->product_id);
        try {
            $expected_amount = $product->price * $this->quantity;
            if ( $this->total_amount < $expected_amount) {
                $this->addError($attribute, "The system DOESN'T accept loss");
            }
        } catch (\Exception $exception) {
            $this->addError($attribute, 'LOSS!!!!');
        }
    }
    public function attributeLabels()
    {
        return [
            'product_id'=>"Sale(s)",
            'sales_date'=>'Date the sale was made',
            'quantity'=>'Quantity which was sold',
            'expected_price'=>'Expected Price',
            'sold_price'=>'Sold Price',
            'total_amount'=>'TOTAL',
        ];
    }
    public function getProduct()
    {
        return $this->hasOne(Product::class,['id'=>'product_id']);
    }
    public function createSales()
    {
        $product = Product::findOne($this->product_id);

        $this->sales_date = date('Y-m-d H:i:s');
        $this->total_amount = $this->quantity * $this->sold_price;
        $this->expected_price = $product->price;
        $this->expected_amount= $product->price * $this->quantity;

        return $this->save();
    }
    public function createNewSales()
    {
        $product = $this->product;

        $this->sales_date = date('Y-m-d H:i:s');
        $this->total_amount = $this->quantity * $this->sold_price;
        $this->expected_price = $product->price;
        $this->expected_amount= $this->expected_price * $this->quantity;


        return $this->save() ;
    }

    public function createUpdate()
    {
        $product = $this->product;

        $this->quantity;
        $this->sold_price;
        $this->total_amount = $this->quantity * $this->sold_price;
        $this->sales_date = date('Y-m-d H:i:s');
        $this->expected_price = $product->price;
        $this->expected_amount= $this->expected_price * $this->quantity;


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