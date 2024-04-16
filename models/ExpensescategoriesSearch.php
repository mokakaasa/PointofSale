<?php

namespace app\models;

use app\models\Expensescategories;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class ExpensescategoriesSearch extends Expensescategories
{

    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 50],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query=Expensescategories::find();

        $expensescategorydataProvider= new ActiveDataProvider(['query'=>$query,'pagination'=>array('pageSize'=>10,),]);

        $this->load($params);

        $query->andFilterWhere([
            'id' =>$this->id,
            'name' =>$this->name,
            'description' =>$this->description,
        ]);

        $query->andFilterWhere(['like','name',$this->name]);
        $query->orderBy('name');
        return $expensescategorydataProvider;
    }



}