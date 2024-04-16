<?php

namespace app\controllers;
use yii;
use app\models\SalesSearch;
use yii\web\Controller;
use app\models\Sales;


class SalesController extends Controller
{
    public function actionSales()
    {
        $salessearchModel = new SalesSearch();
        $salesdataProvider = $salessearchModel->search(Yii::$app->request->queryParams);
        $sales = new Sales();


        if ($sales->load(Yii::$app->request->post())) {
            if ($sales->createSales()) {
                return $this->redirect('sales');
            }
        }

        return $this->render('sales',
            ['salessearchModel' =>  $salessearchModel,
                'salesdataProvider' =>  $salesdataProvider]);
    }

    public function actionNewSales()
    {
        $sales = new Sales();

        if ($sales ->load(Yii::$app->request->post()) && $sales ->validate()) {
            if ($sales ->createNewSales()) {
                Yii::$app->session->setFlash('SALES');
                return $this->redirect('sales');
            }
        }
        return $this->render('newsales', ['sales' => $sales]);
    }

    public function actionViewSales($id)
    {
        $salessearchModel = new SalesSearch();
        $salesdataProvider = $salessearchModel->viewSales($this->request->queryParams);


        return $this->render('viewsales',
            ['salessearchModel' => $salessearchModel,
                'salesdataProvider' => $salesdataProvider,
            ]);
    }
    public function actionView($id)
    {
        $sales = Sales::findOne($id);

        return $this->redirect(['view-sales', 'id' => $sales->id]);

    }
    public function actionUpdate($id)
    {
        $sales = Sales::findOne($id);

        if ( $sales->load(Yii::$app->request->post())) {
            if ( $sales->createUpdate()) {
                Yii::$app->session->setFlash('SALE(s) UPDATE');
                return $this->redirect(['sales', 'id' =>  $sales->id]);
            }
        }
        return $this->render('updatesales', ['sales' =>  $sales]);
    }
    public function actionDeletedItem()
    {
        $salessearchModel = new SalesSearch();
        $salesdataProvider = $salessearchModel->filterDeleted($this->request->queryParams);

        return $this->render('deleted',
            ['salessearchModel' => $salessearchModel,
                'salesdataProvider' => $salesdataProvider
            ]);
    }
    public function actionDelete($id)
    {
        $sales = Sales::findOne($id);

        if ( $sales->createsoftDelete()) {
            return $this->redirect(['deleted-item', 'id' =>$sales->id]);
        }
    }
    public function actionHardDelete()
    {
        $saless =Sales::find()->where(['is_deleted' => 1])->all();

        foreach (  $saless as   $sales) {
            $sales->delete();
        }

        return $this->redirect("deleted-item");
    }
    public function actionPermanentlyDeleteItem($id)
    {
        $sales=Sales::findOne($id);
        $sales->delete();
        return $this->redirect(['deleted-item', 'id' =>  $sales->id]);
    }
    public function actionReversal($id)
    {
        $sales= Sales::findOne($id);

        if ( $sales->createreverse()) {
            return $this->redirect(['sales', 'id' =>  $sales->id]);
        }
    }

}