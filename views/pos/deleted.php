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


$this->title = 'LIST OF ALL DELETED PRODUCTS';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="to_do_list-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $productdataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'price',
            'quantity',
            'description',
            'imagePath',
            [
                'header' => 'Actions',
                'format' => 'raw',
                'value' => function ($product) {
                    $buttons=Html::a( 'RETURN PRODUCT', ['/pos/reversal', 'id' => $product->id,],
                        [
                            'title' => 'Update my To_Do List',
                            'class' => 'btn btn-edit',
                            'data-method'  => 'POST',
                            'data-params'  => ['id' => $product->id ],]);

                    $buttons.=Html::a('DELETE PRODUCT PERMANENTLY' , ['/pos/permanently-delete-item', 'id' => $product->id,],
                        [
                            'title' => 'Delete Product',
                            'class' => 'btn btn-danger',
                            'data-confirm' => "Are you sure you want to permanently delete this task?",
                            'data-method'  => 'POST',
                            'data-params'  => ['id' => $product->id ],]);

                    return $buttons;
                },
            ],
        ],
    ]); ?>
</div>

<p>
    <?= Html::a('CLEAR THE RECYCLE BIN', ['hard-delete'], ['class' => 'btn btn-success']) ?>
</p>

</div>

