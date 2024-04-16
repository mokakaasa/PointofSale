<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Sales $sales*/
/** @var yii\widgets\ActiveForm $form */
?>

<div class="update-expense">


    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($sales, 'quantity')->textInput(['type' => 'number']) ?>
    <?= $form->field($sales, 'sold_price')->textInput(['type' => 'number']) ?>
    <?= $form->field($sales, 'sales_date')->widget(\yii\jui\DatePicker::class, []) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>