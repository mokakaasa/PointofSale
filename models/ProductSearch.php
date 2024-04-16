<?php

namespace app\models;

use app\models\Product;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;


class ProductSearch extends Product
{
    public function rules()
    {
        return [
            [['name', 'price', 'quantity'], 'required'],
            [['description'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 50],
            [['price'], 'number'],
            [['quantity'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();

    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */

    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $productdataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array(
                'pageSize' => 10,
            ),
        ]);

        $this->load($params);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'description'=>$this->description,
            'is_deleted' =>0,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->orderBy('name');
        return $productdataProvider;
    }

    public function filterDeleted($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $productdataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $params['id'] ?? null,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'description'=>$this->description,
        ]);


        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->orderBy('name');
        return $productdataProvider;
    }

}