<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/** @var app\models\Product $product */


$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'List of All Products', 'url' => ['product']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('PRODUCT UPDATE')): ?>

 <div class="alert alert-success">
  'PRODUCT RECORD WAS UPDATED SUCCESSFULLY'
 </div>

<?php endif; ?>

 <?php
echo "Product's ID:".$product->id.'<br>';
echo "Product's Name:".$product->name.'<br>';
echo "Product's Price:".$product->price.'<br>';
echo "Product's Quantity:".$product->quantity.'<br>';
echo "Product's Description:".$product->description.'<br>';
echo "Product's Image:".Html::a(Html::encode($product->imagePath),$product->imagePath).'<br>';

?>
