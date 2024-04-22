<?php

namespace app\models;
use yii\data\ActiveDataProvider;

class SalesSearch extends Sales
{
    public function rules()
    {
        return [
            [['sales_date', 'quantity', 'sold_price','total_amount'], 'required'],
            [['quantity', 'expected_price','sold_price','total_amount','expected_amount'], 'number',],
            [['sales_date'], 'validateSalesDate'],
            [['total_amount'], 'validateExpectedAmount'],
            [['product_id'],'safe'],
            [['product_id'], 'exist', 'targetClass' => '\app\models\Product', 'targetAttribute' => 'id'],
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
        $query = Sales::find();
        $salesdataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 5),
        ]);


        $this->load($params);


        // grid filtering conditions
        $query->andFilterWhere([
            'expected_price' => $this->expected_price,
            'sold_price' => $this->sold_price,
            'quantity' => $this->quantity,
            'sale_date' => $this->sales_date,
            'total_amount' => $this->total_amount,
            'is_deleted' => 0,
        ]);
        return $salesdataProvider;
    }

    public function filterDeleted($params)
    {
        $query = Sales::find();

        // add conditions that should always apply here

        $salesdataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $params['id'] ?? null,
            'expected_price' => $this->expected_price,
            'sold_price' => $this->sold_price,
            'quantity' => $this->quantity,
            'sale_date' => $this->sales_date,
            'total_amount' => $this->total_amount,
            'is_deleted' => 1,
        ]);
        return $salesdataProvider;
    }

    public function viewSales($params)
    {
        $query = Sales::find();

        $salesdataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->joinWith('product');

        $query->andFilterWhere([
            'sales.id' => $params['id'] ?? null,
            'expected_price' => $this->expected_price,
            'sold_price' => $this->sold_price,
            'quantity' => $this->quantity,
            'sales_date' => $this->sales_date,
            'total_amount' => $this->total_amount,
            'sales.is_deleted' =>0,
        ]);
        $query->andFilterWhere(['like', 'product.name', $this->product_id]);

        return $salesdataProvider;
    }


}