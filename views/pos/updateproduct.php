<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $product */
/** @var yii\widgets\ActiveForm $form */
?>
<?php if (Yii::$app->session->hasFlash('PRODUCT')): ?>

    <div class="alert alert-success">
        'A NEW PRODUCT RECORD WAS CREATED SUCCESSFULLY'
    </div>

<?php endif; ?>

<div class="new-product">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($product, 'price')->textInput(['type' => 'number']) ?>
    <?= $form->field($product, 'quantity')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>