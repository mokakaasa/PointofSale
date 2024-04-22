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
        ArrayHelper::map(\app\models\Product::find()->all(), 'id',
            function ($model) {
                return "Sale's Name:". $model->name . ' , ' ."Expected Price:". $model->price; // Combine name and price
            }),
        ['prompt' => 'Sale(s) Name and Expected Price']
    ) ?>

    <?= $form->field($sales, 'quantity')->textInput(['type' => 'number', 'id' => 'quantity', 'onkeyup' => "getTotalAmount()"]) ?>

    <?= $form->field($sales, 'sold_price')->textInput(['type' => 'number', 'id' => 'sold_price', 'onkeyup' => "getTotalAmount()"]) ?>

    <?= $form->field($sales, 'total_amount')->textInput(['type' => 'number', 'readonly' => true, 'id' => 'total_amount']) ?>

    <?= $form->field($sales, 'sales_date')->widget(\yii\jui\DatePicker::class, []) ?>

    <script>
        const getTotalAmount = () => {
            const quantityField = document.getElementById('quantity');
            const soldPriceField = document.getElementById('sold_price');
            const totalAmountField = document.getElementById('total_amount');

            if (Number(quantityField.value) && Number(soldPriceField.value)) {
                totalAmountField.value = Number(quantityField.value) * Number(soldPriceField.value);
            }
        }
    </script>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
