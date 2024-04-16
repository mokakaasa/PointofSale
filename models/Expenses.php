<?php

namespace app\models;

use yii\db\ActiveRecord;

class Expenses extends ActiveRecord
{
 public static function tableName()
 {
     return 'expenses';
 }

 public function rules()
 {
     return [
         [['expense_category_id','quantity','unit_price','amount','date'],'required'],
         [['expense_category_id'],'number'],
         [['quantity'],'number'],
         [['unit_price'],'number'],
         [['amount'],'number'],
         [['date'],'validateDate'],
     ];
 }

    public function validateDate($attribute, $params)
    {
        try {
            $expenses_date = strtotime($this->sales_date);
            $todays_date = strtotime(date('Y-m-d'));

            if ((!expenses_date == $todays_date)) {
                $this->addError($attribute, 'The Date Expense was created should be recorded daily.');
            }
        } catch (\Exception $exception) {
            $this->addError($attribute, 'Invalid Format Date');
        }
    }
 public function attributeLabels()
 {
     return [
         'expense_category_id'=>'EXPENSE ID',
         'quantity' => 'Quantity of the Expenses',
         'unit_price' => 'Unit Price of the Expenses',
         'amount' => 'Amount of the Expense',
         'date' => 'Date the Expense was created ',
     ];
 }
 public function getExpensescategories()
 {
    return $this->hasMany(Expensescategories::class, [['id'=>'expense_category_id']]);
 }
    public function createExpenses()
    {
        return $this->save();
    }

}