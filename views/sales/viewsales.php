<?php

use app\models\Product;
use app\models\Sales;
use app\models\SalesSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\SerialColumn;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;
use yii\data\Pagination;

/** @var yii\web\View $this */
/** @var app\models\SalesSearch $salessearchModel */
/** @var app\models\Product $product*/
/** @var app\models\Sales $sales*/
/** @var yii\data\ActiveDataProvider $salesdataProvider */
/** @var yii\data\ActiveDataProvider $pagination */

$this->title = 'SALE(s) DETAILS';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('SALE(s) UPDATE')): ?>

    <div class="alert alert-success">
        'SALE(s) RECORD WAS UPDATED SUCCESSFULLY'
    </div>

<?php endif; ?>

<div class="viewexpenses-index">
    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $salesdataProvider,
        'columns'=>[
            ['class'=>'yii\grid\SerialColumn'],
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
            'total_amount',

        ],
    ]); ?>
</div>

</div>
