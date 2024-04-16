<?php

namespace app\models;
use yii\db\ActiveRecord;

class Expensescategories extends ActiveRecord
{
public static  function tableName()
{
     return 'expense_categories';
}

public function rules()
{
   return [
        [['name', 'description'], 'required'],
        [['description'], 'string', 'max' => 50],
        [['name'], 'string', 'max' => 50],
    ];
}
public function attributeLabels()
{
   return [
       'name'=>'Expense(s) Name',
       'description'=>'Describe the Expense(s)'
   ];
}
public function getExpenses()
{
        return $this->hasOne(Expenses::class, [['expense_category_id' => 'id']]);
}
    public function createExpenseCategory()
    {
        return $this->save();
    }

    public function createNewExpensesCategory()
    {
        return $this->save();
    }


}