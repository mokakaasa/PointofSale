<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProductModel $product */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="new-product">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($product, 'price')->textInput(['type' => 'number']) ?>
    <?= $form->field($product, 'quantity')->textInput(['type' => 'number']) ?>
    <?= $form->field($product, 'description')->textarea(['rows' => 2]) ?>
    <?= $form->field($product, 'imageFile')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>