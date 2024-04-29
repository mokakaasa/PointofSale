<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Sales $sales */
/** @var app\models\Product $product */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="new-sales">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($sales, 'product_id')->dropDownList(
        ArrayHelper::map(\app\models\Product::find()->all(),'id','name'),
        ['prompt'=>"Sale's Name",'id' => 'product_id']
    ) ?>

   <?= $form->field($sales, 'expected_price')->textInput(['type' => 'number', 'readonly' => true, 'id' => 'expected_price']) ?>

    <?= $form->field($sales, 'quantity')->textInput(['type' => 'number', 'id' => 'quantity', 'onkeyup' => "getTotalAmount()"]) ?>

    <?= $form->field($sales, 'sold_price')->textInput(['type' => 'number', 'id' => 'sold_price', 'onkeyup' => "getTotalAmount()"]) ?>

    <?= $form->field($sales, 'total_amount')->textInput(['type' => 'number', 'readonly' => true, 'id' => 'total_amount']) ?>

    <?= $form->field($sales, 'sales_date')->widget(\yii\jui\DatePicker::class, []) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
