<?php

use app\models\Product;
use app\models\ProductSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;
use yii\data\Pagination;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $productsearch */
/** @var app\models\Product $product */
/** @var yii\data\ActiveDataProvider $productdataProvider */
/** @var yii\data\ActiveDataProvider $pagination */


$this->title = 'LIST OF ALL PRODUCTS';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index">
    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $productdataProvider,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['width' => '300'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $product, $key) {
                        return Html::a('Update Product' ,$url, ['class' => 'btn btn-info']);
                    },
                    'view' => function ($url, $product, $key) {
                        return Html::a('View Product' ,$url, ['class' => 'btn btn-info']);
                    },
                    'delete' => function ($url, $product, $key) {
                        return Html::a('Delete Product' , ['/pos/delete', 'id' => $product->id,], ['class' => 'btn btn-info']);
                    }


                ],
            ],
            'name',
            'price',
            'quantity',
            'description',
        ],


    ]); ?>

</div>

<p>
    <?= Html::a('Create New Product', ['new-product'], ['class' => 'btn btn-success']) ?>
</p>

<p>
    <?= Html::a('View Trashed Products', ['deleted-item'], ['class' => 'btn btn-success']) ?>
</p>


</div>
