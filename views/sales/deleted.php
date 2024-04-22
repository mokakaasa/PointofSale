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
/** @var app\models\Sales $sales */
/** @var yii\data\ActiveDataProvider $salesdataProvider */
/** @var yii\data\ActiveDataProvider $pagination */


$this->title = 'LIST OF ALL DELETED SALE(s)';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sales-deleted">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $salesdataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'quantity',
            'expected_price',
            'sold_price',
            'sales_date',
            'total_amount',
            [
                'header' => 'Actions',
                'format' => 'raw',
                'value' => function ( $sales) {
                    $buttons=Html::a( 'RETURN THIS SALE RECORD', ['/sales/reversal', 'id' =>  $sales ->id,],
                        [
                            'title' => 'Return this Sale(s)',
                            'class' => 'btn btn-edit',
                            'data-method'  => 'POST',
                            'data-params'  => ['id' => $sales->id ],]);

                    $buttons.=Html::a('DELETE THIS SALE RECORD PERMANENTLY' , ['/sales/permanently-delete-item', 'id' =>  $sales->id,],
                        [
                            'title' => 'Delete This Sale(s)',
                            'class' => 'btn btn-danger',
                            'data-confirm' => "Are you sure you want to permanently delete this sale(s)?",
                            'data-method'  => 'POST',
                            'data-params'  => ['id' => $sales->id ],]);

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

