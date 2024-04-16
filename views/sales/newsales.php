<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;



/** @var yii\web\View $this */
/** @var app\models\Sales $sales */
/** @var app\models\Product $product */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="new-expense">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($sales, 'product_id')->dropDownList(
        ArrayHelper::map(\app\models\Product::find()->all(),'id','name'),
        ['prompt'=>'Sale(s) Name']
    ) ?>
    <?= $form->field($sales, 'quantity')->textInput(['type' => 'number']) ?>
    <?= $form->field($sales, 'expected_price')->textInput(['type' => 'number']) ?>
    <?= $form->field($sales, 'sold_price')->textInput(['type' => 'number']) ?>
    <?= $form->field($sales, 'sales_date')->widget(\yii\jui\DatePicker::class, []) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
