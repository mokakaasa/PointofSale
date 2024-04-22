<?php

use app\models\Sales;
use app\models\SalesSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;
use yii\data\Pagination;

/** @var yii\web\View $this */
/** @var app\models\SalesSearch $salessearchModel */
/** @var app\models\Sales $sales*/
/** @var yii\data\ActiveDataProvider $salesdataProvider */
/** @var yii\data\ActiveDataProvider $pagination */


$this->title = 'LIST OF ALL SALES';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('SALES')): ?>

    <div class="alert alert-success">
        'A NEW SALES RECORD CREATED SUCCESSFULLY'
    </div>

<?php endif; ?>

<div class="sales">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $salesdataProvider,
        'pager' => [
            'class' => 'yii\bootstrap5\LinkPager',
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last'
        ],
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['width' => '300'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'update' => function ($url,$sales, $key) {
                        return Html::a('Update Sales' ,$url, ['class' => 'btn btn-info']);
                    },
                    'view' => function ($url,$sales, $key){
                        return Html::a('View Sales' , ['/sales/view', 'id' => $sales->id,], ['class' => 'btn btn-info']);
                    },
                    'delete' => function ($url, $sales, $key) {
                        return Html::a('Delete Sales'  ,  ['/sales/delete', 'id' => $sales->id,], ['class' => 'btn btn-info']);
                    }
                ],
            ],
            [
                'attribute' => 'product_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->product->name;
                },

            ],
            [
                'attribute' => 'expected_price',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->product->price;
                },

            ],
            'quantity',
            'sold_price',
            'sales_date',
            'total_amount'
        ],


    ]); ?>

</div>

<p>
    <?= Html::a('Create New Sales', ['new-sales'], ['class' => 'btn btn-success']) ?>
</p>

<p>
    <?= Html::a('View Trashed Sales', ['deleted-item'], ['class' => 'btn btn-success']) ?>
</p>

</div>