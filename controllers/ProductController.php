<?php

namespace app\controllers;


use app\models\ProductModel;
use yii\web\Controller;
use Yii;
use yii\web\Response;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\UploadedFile;


class  ProductController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionProduct()
    {
        $productsearchModel = new ProductSearch();
        $productdataProvider = $productsearchModel->search(Yii::$app->request->queryParams);
        $product = new Product();

        if ($product->load(Yii::$app->request->post()) && $product->validate()) {
            if ($product->createProduct()) {
                return $this->redirect('product');
            }
        }

        return $this->render('product',
            ['productsearchModel' => $productsearchModel,
                'productdataProvider' => $productdataProvider,
            ]);
    }


    public function actionNewProduct()
    {
        $productModel = new ProductModel();

        if ($productModel->load(Yii::$app->request->post())) {
            $productModel->imageFile = UploadedFile::getInstance($productModel, 'imageFile');

            $product = new Product();
            // Check if imageFile is empty
            if ($product->createNewProduct($productModel)) {
                Yii::$app->session->setFlash('PRODUCT');
                return $this->redirect('product');
            }
        }
        return $this->render('newproduct', ['product' => $productModel]);
    }

    public function actionGetExpectedPrice($id)
    {

        $product = Product::findOne($id);

        return $product->price;
    }


    public function actionUpdate($id)
    {
        $product = Product::findOne($id); // Fetch the existing product

        if ($product === null) {
            throw new \yii\web\NotFoundHttpException('The requested product does not exist.');
        }

        if ($product->load(Yii::$app->request->post())) {


            if ($product->createUpdate()) {
                Yii::$app->session->setFlash('PRODUCT UPDATE');
                return $this->redirect(['view', 'id' => $product->id]); // Redirect to the product view page
            }
        }

        return $this->render('updateproduct', ['product' => $product, 'id' => $id]); // Render the update form
    }

    public function actionView($id)
    {

        $product = Product::findOne($id);

        return $this->render('viewproduct', ['product' => $product, 'id' => $id]);
    }

    public function actionDeletedItem()
    {
        $productsearchModel = new ProductSearch();
        $productdataProvider = $productsearchModel->filterDeleted($this->request->queryParams);


        return $this->render('deleted',
            ['productsearchModel' => $productsearchModel,
                'productdataProvider' => $productdataProvider,
            ]);
    }

    public function actionDelete($id)
    {
        $product = Product::findOne($id);

        if ($product->createsoftDelete()) {
            return $this->redirect(['deleted-item', 'id' => $product->id]);
        }
    }
    public function actionHardDelete()
    {
        $products =Product::find()->where(['is_deleted' => 1])->all();

        foreach ( $products as  $product) {
            $product->delete();
        }

        return $this->redirect("deleted-item");
    }
    public function actionPermanentlyDeleteItem($id)
    {
        $product=Product::findOne($id);
        $product->delete();
        return $this->redirect(['deleted-item', 'id' => $product->id]);
    }

    public function actionReversal($id)
    {
        $product = Product::findOne($id);

        if ( $product->createreverse()) {
            return $this->redirect(['product', 'id' =>  $product->id]);
        }
    }
}