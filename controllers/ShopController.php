<?php

namespace app\controllers;

use app\models\Category;
use app\models\ShopCategory;
use Yii;
use app\models\Shop;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShopController implements the CRUD actions for Shop model.
 */
class ShopController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors(){
        return ['verbs' => ['class' => VerbFilter::className(), 'actions' => ['delete' => ['POST'],],],];
    }

    /**
     * Lists all Shop models.
     * @return mixed
     */
    public function actionIndex(){
        $dataProvider = new ActiveDataProvider(['query' => Shop::find(),]);

        return $this->render('index', ['dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single Shop model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id){
        return $this->render('view', ['model' => $this->findModel($id),]);
    }

    /**
     * Creates a new Shop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new Shop();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->shop_id]);
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }

    public function actionTest(){

//        $model = Category::find()->where(['category_id'=> 5])->andWhere(['like','name','книги'])->asArray()->all();
//        $model = Category::find()->where(['category_id'=> 5])->asArray()->all();
//        $model = Category::find()->where(['category_id'=> 5])->andWhere(['like','name','книги'])->exists();
        $model = ShopCategory::find()->where(['shop_id'=>1])->all();

        return $this->render('test', ['model' => $model,]);
        
    }



    /**
     * Updates an existing Shop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->shop_id]);
        } else {
            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing Shop model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Shop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = Shop::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
