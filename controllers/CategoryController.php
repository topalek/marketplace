<?php

namespace app\controllers;

use app\models\Brand;
use app\models\CategoryAlias;
use app\models\Param;
use app\models\Product;
use app\models\Shop;
use app\models\ShopCategory;
use app\models\ShopForm;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\Connection;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors(){
        return ['verbs' => ['class' => VerbFilter::className(), 'actions' => ['delete' => ['POST'],],],];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex(){
        $dataProvider = new ActiveDataProvider(['query' => Category::find()->with('category')]);

        return $this->render('index', ['dataProvider' => $dataProvider,]);
    }

//    public function actionBrand(){
//
//        return $this->render('brand',compact())
//    }


    /**
     * @return string
     */
    public function actionImport(){
//        $this->downloadXml();
        $shops = Shop::find()->asArray()->all();

        if (Yii::$app->request->post('shop')) {
            $shop_id = Yii::$app->request->post('shop');
            $shop = Shop::findOne($shop_id);

            $category = $this->shopCategoryToDb($shop);

            return $this->render('import', compact('shops', 'shop', 'category'));
        }

        if (Yii::$app->request->post('product')) {
            $shop_id = Yii::$app->request->post('product');
            $shop = Shop::findOne($shop_id);

            $product = $this->shopProductToDb($shop);

            return $this->render('import', compact('shops', 'shop', 'product'));
        }

        if (Yii::$app->request->post('brand')) {
            $shop_id = Yii::$app->request->post('brand');
            $shop = Shop::findOne($shop_id);

            $brands = $this->getBrandArray($shop);

//            $count = $this->brandsToDb($brands);

            return $this->render('brand', compact('shops', 'shop', 'brands'));
        }

        return $this->render('import', compact('shops'));

    }

    private function brandsToDb($brands){
        $i = 0;
        foreach ($brands as $brand_name) {

            if (!Brand::find()->where(['like', 'name', $brand_name])->exists()) {
                $brand = new Brand();
                $brand->name = $brand_name;
                if ($brand->save()) $i++;
            }
        }

        return $i;
    }

    private function getXmlPath($shop){
        return Yii::getAlias('@import') . '/' . str_replace(' ', '_', strtolower($shop->name)) . '.xml';
    }

    private function getBrandArray($shop){
        $name = $this->getXmlPath($shop);
        if (file_exists($name)) {
            $product = $this->getProductArray($shop);
            $brands = array();
            foreach ($product as $item) {
                if (!in_array($item['brand_name'], $brands)) $brands[] = $item['brand_name'];

            }
            $brands = array_filter($brands);

            return $brands;
        }

        return false;
    }

    private function shopProductToDb($shop){
        $name = $this->getXmlPath($shop);
        if (file_exists($name)) {
            $err = array();
            $time_update = time();
            Product::updateAll(['status' => 0], 'shop_id = :shop_id and time_update < :time_update', [':shop_id' => $shop->shop_id, ':time_update' => $time_update]);
            $product = $this->getProductArray($shop);
            $brands = ArrayHelper::map(Brand::find()->asArray()->indexBy('brand_id')->all(), 'brand_id', 'name');
            foreach ($product as $item) {
                $model = Product::find()->where(['code' => $item['code']])->andWhere(['shop_id' => $shop->shop_id])->andWhere(['like', 'name', $item['name']])->one();

                if (!$model) {
                    $brand_id = array_keys($brands, $item['brand_name'])[0] ? array_keys($brands, $item['brand_name'])[0] : 0;
                    $shop_prod = new Product();
                    $shop_prod->name = mb_strtolower($item['name'], 'UTF-8');
                    $shop_prod->slug = mb_strtolower($item['slug'], 'UTF-8');
                    $shop_prod->price = $item['price'];
                    $shop_prod->img = $item['img'];
                    $shop_prod->url = $item['url'];
                    $shop_prod->brand_name = $item['brand_name'];
                    $shop_prod->brand_id = $brand_id;
                    $shop_prod->category_id = $item['category_id'];
                    $shop_prod->shop_id = $shop->shop_id;
                    $shop_prod->xml_id = $item['xml_id'];
                    $shop_prod->code = $item['code'];
                    $shop_prod->status = $item['status'];
                    $shop_prod->description = $item['description'];
                    $shop_prod->time_update = $time_update;
                    if (!$shop_prod->save()) {
                        $err[]['errors'] = $shop_prod->getErrors();
                        $err[]['error_shop'] = $shop->name;
                        $err[]['error_xml_id'] = $item['xml_id'];
                    }

                } else {
                    $brand_id = array_keys($brands, $item['brand_name'])[0] ? array_keys($brands, $item['brand_name'])[0] : 0;
                    $model->name = mb_strtolower($item['name'], 'UTF-8');
                    $model->slug = mb_strtolower($item['slug'], 'UTF-8');
                    $model->price = $item['price'];
                    $model->img = $item['img'];
                    $model->url = $item['url'];
                    $model->brand_name = $item['brand_name'];
                    $model->brand_id = $brand_id;
                    $model->category_id = $item['category_id'];
                    $model->shop_id = $shop->shop_id;
                    $model->xml_id = $item['xml_id'];
                    $model->code = $item['code'];
                    $model->status = $item['status'];
                    $model->description = $item['description'];
                    $model->time_update = $time_update;
                    if (!$model->save()) {
                        $err[]['errors'] = $model->getErrors();
                        $err[]['error_shop'] = $shop->name;
                        $err[]['error_xml_id'] = $item['xml_id'];
                    }

                }

            }

            if (!empty($err))
                echo '<pre>' . print_r($err) . '</pre>';

            return $product;
        }

        return false;
    }

    /**
     *
     */
    private function shopCategoryToDb($shop){

//        $shops = Shop::find()->asArray()->all();

//        foreach ($shops as $shop) {
        $name = $this->getXmlPath($shop);

        if (file_exists($name)) {
            $category = $this->getCategoryArray($name, $shop->method_xml);
            foreach ($category as $item) {
                $model = ShopCategory::find()->where(['category_id' => $item['id']])->andWhere(['like', 'name', $item['name']])->exists();

                if (!$model) {
                    $shop_cat = new ShopCategory();
                    $shop_cat->shop_category_id = $item['id'];
                    $shop_cat->shop_parent_id = $item['parent_id'];
                    $shop_cat->shop_id = $shop->shop_id;
                    $shop_cat->name = mb_strtolower($item['name'], 'UTF-8');
                    $shop_cat->save();
                }

            }

            return $category;
        }
        // если нет хмл, то отправить письмо с соответствующим текстом
//        }
//        d($category);
        return false;
    }

//    private function xmlFiles(){
//        list($controller) = Yii::$app->createController('shop');
//        $xml = $controller->downloadXml();
//        foreach ($xml as $k=>$v) {
//            $xml[$k] = Yii::getAlias('@app').'/'.$v;
//        }
//        return $xml;
//    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionCompare(){
        $shop = null;

        if (Yii::$app->request->post('shop')) {
            $shop = Yii::$app->request->post('shop');

            $category = ShopCategory::find()->asArray()->where(['shop_id' => $shop])->all();

            return $this->render('compare', compact('model', 'category', 'shop'));
        }
//        $xml = $this->shopCategoryToDb();

        $model = new ShopForm();

        return $this->render('compare', compact('model', 'xml', 'shop'));
    }

    private function readyXml($xml){

//        if (file_exists('c:\OpenServer\import.xml')){
//            $file = file_get_contents('c:\OpenServer\import.xml');
//        } else {
//        }
        $file = file_get_contents($xml);


        if (strrpos($file, 'parentID')) {
            $file = str_replace('parentID', 'parentId', $file);
        }

        if (strrpos($file, 'CDATA')) {
            $pat = "/(<category id=\"\d+\"?.+>)<!\[CDATA\[(.+)\]\]>(<\/category>)/";
            $file = preg_replace($pat, "$1<name>$2</name>$3", $file);
        }
        $pat = "/(<category id=\"\d+\"?.+>)(.+)(<\/category>)/";
        $file = preg_replace($pat, "$1<name>$2</name>$3", $file);

        if (strrpos($file, 'param')) {
            $pat = '/(<param name=".+"?.+>)(.+)(<\/param>)/';
            $file = preg_replace($pat, "$1<val>$2</val>$3", $file);
        };

        if (!strrpos($file, '<description><![CDATA[')) {
            $pat = '/(<description>)/';
            $file = preg_replace($pat, "$1<![CDATA[", $file);
            $pat = '/(<\/description>)/';
            $file = preg_replace($pat, "]]>$1", $file);
        };
        $pat = '/(<name>)(.+)(<\/name)/';
        $file = preg_replace($pat, "$1<![CDATA[$2]]>$3", $file);

        $file = str_replace('picture', 'image', $file);
        $file = str_replace('<!DOCTYPE yml_catalog SYSTEM "shops.dtd">', "", $file);
        $file = str_replace('<![CDATA[<![CDATA[', '<![CDATA[', $file);
        $file = str_replace(']]>]]>', ']]>', $file);

        return $file;
    }

    private function getYandexCategory($imported_shop){
        $shop = (array)$imported_shop->shop;
        // формируем массив категорий
        $category = array();
        foreach ($shop['categories']->category as $cat) {
            $category[(int)$cat->attributes()->id]['name'] = strtolower((string)$cat->name);
            $category[(int)$cat->attributes()->id]['id'] = (int)$cat->attributes()->id;
            $category[(int)$cat->attributes()->id]['parent_id'] = (int)$cat->attributes()->parentId ? (int)$cat->attributes()->parentId : 0;
        }

        return $category;

    }

    private function getHotlineCategory($imported_shop){

        $shop = (array)$imported_shop;
        $category = array();

        // формируем массив категорий

        foreach ($shop['categories']->category as $cat) {
            $category[(int)$cat->id]['name'] = strtolower(trim((string)$cat->name));
            $category[(int)$cat->id]['id'] = (int)$cat->id;
            $category[(int)$cat->id]['parent_id'] = (int)$cat->parentId ? (int)$cat->parentId : 0;
        }

        return $category;

    }

    private function getAfkCategory($imported_shop){

        $imported_shop = $imported_shop->data->row;
        $category = array();
        foreach ($imported_shop as $item) {
            $category[(int)$item->class_id]['name'] = strtolower((string)$item->class_name);
            $category[(int)$item->class_id]['id'] = (int)$item->class_id;
            $category[(int)$item->class_id]['parent_id'] = 0;
        }

        return $category;

    }

    private function shopImport($xml){

        $file = $this->readyXml($xml);

        if (strrpos($file, 'yml_catalog')) {
            $agr = 'y';
        } else {
            $agr = 'h';
        };
        $import_file = Yii::getAlias('@import') . '/import.xml';
        file_put_contents($import_file, $file);
//        $file = 'c:\OpenServer\import.xml';
        $sxml = simplexml_load_file($import_file, 'SimpleXMLElement', LIBXML_NOCDATA);

        $imported_shop = $sxml;

        return $imported_shop;
    }

    private function getCategoryArray($xml, $type = 'h'){

        $imported_shop = $this->shopImport($xml);
        $category = array();

        if ($type == 'y') {
            $category = $this->getYandexCategory($imported_shop);
        };

        if ($type == 'h') {

            $category = $this->getHotlineCategory($imported_shop);

        }

        if ($type == 'afk') {
            $category = $this->getAfkCategory($imported_shop);
        }

        return $category;
    }


    private function getProductArray($shop){
        $type = $shop->method_xml;
        $xml = $this->getXmlPath($shop);
        $imported_shop = $this->shopImport($xml);
        $product = array();

        if ($type == 'y') {
            $product = $this->getYandexProduct($imported_shop);
        };

        if ($type == 'h') {

            $product = $this->getHotlineProduct($imported_shop);

        }

        if ($type == 'afk') {
            $product = $this->getAfkProduct($imported_shop);
        }

        return $product;
    }

    private function getYandexProduct($imported_shop){

        $shop = (array)$imported_shop->shop;
        $prod = array();
        $param = array();
        $i = 0;
        foreach ($shop['offers']->offer as $item) {

            $id = (int)$item->attributes()->id;
            $prod[$i]['name'] = mb_strtolower(trim((string)$item->name), 'utf-8');
            $prod[$i]['slug'] = translit(mb_strtolower(trim((string)$item->name), 'utf-8'));
            $prod[$i]['price'] = (float)$item->price;
            $prod[$i]['img'] = (string)$item->image;
            $prod[$i]['url'] = (strpos((string)$item->url,'?')) ? explode('?',(string)$item->url)[0]:(string)$item->url;
            $prod[$i]['brand_name'] = (string)$item->vendor ? trim(mb_strtolower((string)$item->vendor, 'utf-8')) : '';
            $prod[$i]['category_id'] = (int)$item->categoryId;
            $prod[$i]['xml_id'] = $id;
            $prod[$i]['code'] = (string)$item->code;

            // устанавливаем наличие товара 1,
            // если не обнаружено строки или атрибута, отвечающего за это

            if (isset($item->attributes()->available)) {
                $prod[$i]['status'] = (int)((bool)$item->attributes()->available);
            } elseif (isset($item->status)) {
                $prod[$i]['status'] = (int)((bool)$item->status);
            } else {
                $prod[$i]['status'] = 1;
            }
            // $prod[$id]['description'] = (string)$item->description;
            $prod[$i]['description'] = (string)$item->description ? (string)$item->description : (string)$item->name;

            $i++;
        }

        return $prod;
    }

    private function getHotlineProduct($imported_shop){

        $shop = (array)$imported_shop;
        $prod = array();

        $i = 0;
        foreach ($shop['items']->item as $item) {
            $id = (int)$item->id;
            $prod[$i]['name'] = mb_strtolower((string)$item->name, 'utf-8');
            $prod[$i]['slug'] = translit(mb_strtolower((string)$item->name, 'utf-8'));
            $prod[$i]['price'] = (float)$item->priceRUAH;
            $prod[$i]['url'] = (strpos((string)$item->url,'?')) ? explode('?',(string)$item->url)[0]:(string)$item->url;
            $prod[$i]['img'] = (string)$item->image;
            $prod[$i]['brand_name'] = (string)$item->vendor ? trim(mb_strtolower((string)$item->vendor, 'utf-8')) : '';
            $prod[$i]['category_id'] = (int)$item->categoryId;
            $prod[$i]['xml_id'] = $id;
            $prod[$i]['code'] = (string)$item->code;

            // устанавливаем наличие товара 1,
            // если не обнаружено строки или атрибута, отвечающего за это
            if (isset($item->stock)) {
                $prod[$i]['status'] = (int)((bool)$item->stock);
            } else {
                $prod[$i]['status'] = 1;
            }
            $prod[$i]['description'] = (string)$item->description ? (string)$item->description : (string)$item->name;
            $i++;
        }

        return $prod;
    }

    private function getAfkProduct($imported_shop){

        $shop = $imported_shop->data;
        $prod = array();
        $i = 0;
        foreach ($shop->row as $item) {

            $id = (int)$item->goods_name_id;
            $prod[$i]['name'] = mb_strtolower(trim((string)$item->goods_name), 'utf-8');
            $prod[$i]['slug'] = translit(mb_strtolower(trim((string)$item->goods_name), 'utf-8'));
            $prod[$i]['price'] = (float)$item->msrp;
            $prod[$i]['url'] = (string)$item->goods_name;
            $prod[$i]['img'] = (string)$item->image_url;
            $prod[$i]['brand_name'] = (string)$item->producer ? trim(mb_strtolower((string)$item->producer, 'utf-8')) : '';
            $prod[$i]['category_id'] = (int)$item->class_id;
            $prod[$i]['xml_id'] = $id;
            $prod[$i]['code'] = (string)$item->part_number;

            // устанавливаем наличие товара 1,
            // если не обнаружено строки или атрибута, отвечающего за это
            if (isset($item->stock)) {
                $prod[$i]['status'] = (int)((bool)$item->stock);
            } else {
                $prod[$i]['status'] = 1;
            }
            $prod[$i]['description'] = (string)$item->description ? (string)$item->description : (string)$item->name;
            $i++;
        }

        return $prod;
    }


    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id){
        return $this->render('view', ['model' => $this->findModel($id),]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new Category();
//        d($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->category_id]);
        } else {
//            d($_POST);
            return $this->render('create', ['model' => $model,]);
        }
    }

    public function actionSave(){

        if (Yii::$app->request->post()) {

            $category = Yii::$app->request->post('category');
            $model = ShopCategory::findOne($category[0]);
            $model->category_id = (int)$category[2];
            if ($model->save()) {
                return 'success';
            };


        }


        return $this->render('create');

    }

    public function searchAlias($str){

        $model = CategoryAlias::find()->where(['like', 'alias', $str])->all();

        return $model;
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->category_id]);
        } else {
            return $this->render('update', ['model' => $model,]);
        }
    }

    public function actionRebuild(){

        $query = Category::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 25, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $model = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('rebuild', compact('model', 'pages'));
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function downloadXml(){

        $model = Shop::find()->all();
        $xml = array();
        foreach ($model as $shop) {
            $file = str_replace(' ', '_', strtolower($shop->name)) . '.xml';
            $to = Yii::getAlias('@import') . '/' . $file;
            $xml[] = $file;
            $this->copySecureFile($shop->xml_url, $to);
        }

        return $xml;

    }

    public function getParamArray($shop){
        $type = $shop->method_xml;
        $xml = $this->getXmlPath($shop);

        $imported_shop = $this->shopImport($xml);
        $param = array();

        if ($type == 'y') {
            $param = $this->getYandexParam($imported_shop);
        };

        if ($type == 'h') {
            $param = $this->getHotlineParam($imported_shop);

        }

        if ($type == 'afk') {
            $param = $this->getAfkParam($imported_shop);
        }

        return $param;
    }


    private function getYandexParam($imported_shop){
        $shop = $imported_shop->shop;
        $param = array();
        // формируем массив параметров товаров
        $i = 0;
        foreach ($shop->offers->offer as $item) {
            $id = (int)$item->attributes()->id;

            $j=0;
            foreach ($item->param as $p) {

                if ((string)$p->val) {
                    if (strpos((string)$p->attributes()->name,'комментариев к элементу')) continue;

                        if (strpos($p->attributes()->name, ',')) {
                            $prop = explode(',', (string)$p->attributes()->name);
                            $param[$i][$j]['prod_id'] = $id;
                            $param[$i][$j]['name'] = mb_strtolower(trim($prop[0]), 'utf-8');
                            $param[$i][$j]['unit'] = mb_strtolower(trim($prop[1]), 'utf-8');
                            $param[$i][$j]['val'] = trim((string)$p->val);
                            $j++;
                            continue;
                        }

                        $param[$i][$j]['prod_id'] = $id;
                        $param[$i][$j]['name'] = ((string)$p->attributes()->name) ? mb_strtolower((string)$p->attributes()->name, 'utf-8') : '';
                        $param[$i][$j]['unit'] = ((string)$p->attributes()->unit) ? mb_strtolower((string)$p->attributes()->unit, 'utf-8') : '';
                        $param[$i][$j]['val'] = trim((string)$p->val);
                        $j++;
                }

            }
            if (count($item->param)>0 && $j!=0) $i++;


        }

        return $param;
    }

    private function getHotlineParam($imported_shop){
//        d($imported_shop);
        $shop = $imported_shop;
        $param = array();
        $i = 0;
        // формируем массив параметров товаров
        foreach ($shop->items->item as $item) {
            $id = (int)$item->id;

            $j=0;
            foreach ($item->param as $p) {
                if ((string)$p->val) {

                    if (strpos($p->attributes()->name, ',')) {
                        $prop = explode(',', (string)$p->attributes()->name);
                        $param[$i][$j]['prod_id'] = $id;
                        $param[$i][$j]['name'] = mb_strtolower(trim($prop[0]),'utf-8');
                        $param[$i][$j]['unit'] = mb_strtolower(trim($prop[1]),'utf-8');
                        $param[$i][$j]['val'] = trim((string)$p->val);
                        $j++;
                        continue;
                    }

                    $param[$i][$j]['prod_id'] = $id;
                    $param[$i][$j]['name'] = ((string)$p->attributes()->name) ? mb_strtolower((string)$p->attributes()->name,'utf-8') : '';
                    $param[$i][$j]['unit'] = ((string)$p->attributes()->unit) ? mb_strtolower((string)$p->attributes()->unit,'utf-8') : '';
                    $param[$i][$j]['val'] = trim((string)$p->val);
                    $j++;
                }

            }
            if (count($item->param)>0 && $j!=0) $i++;
        }

        return $param;
    }


    private function getAfkParam($imported_shop){
//        d($imported_shop);
        $shop = $imported_shop->data;
        $param = array();
        // формируем массив параметров товаров
        $i = 0;
        foreach ($shop->row as $item) {
            $id = (int)$item->goods_name_id;

            if ($item->goods_height) {
                $param[$i][0]['prod_id'] = $id;
                $param[$i][0]['name'] = 'высота';
                $param[$i][0]['unit'] = 'см';
                $param[$i][0]['val'] = (int)$item->goods_height;
                $param[$i][1]['prod_id'] = $id;
                $param[$i][1]['name'] = 'ширина';
                $param[$i][1]['unit'] = 'см';
                $param[$i][1]['val'] = (int)$item->goods_width;
                $param[$i][2]['prod_id'] = $id;
                $param[$i][2]['name'] = 'длинна';
                $param[$i][2]['unit'] = 'см';
                $param[$i][2]['val'] = (int)$item->goods_length;
                $param[$i][3]['prod_id'] = $id;
                $param[$i][3]['name'] = 'вес';
                $param[$i][3]['unit'] = 'кг';
                $param[$i][3]['val'] = (int)$item->goods_weight;
                $i++;
            }
        }

        return $param;
    }

    /**
     * @param $FromLocation
     * @param $ToLocation
     * @param bool $VerifyPeer
     * @param bool $VerifyHost
     * @return bool
     */
    private function copySecureFile($FromLocation, $ToLocation, $VerifyPeer = false, $VerifyHost = false){
        // Initialize CURL with providing full https URL of the file location
        $Channel = curl_init($FromLocation);

        // Open file handle at the location you want to copy the file: destination path at local drive
        $File = fopen($ToLocation, "w");

        // Set CURL options
        curl_setopt($Channel, CURLOPT_FILE, $File);

        // We are not sending any headers
        curl_setopt($Channel, CURLOPT_HEADER, 0);

        curl_setopt($Channel, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");

        // Disable PEER SSL Verification: If you are not running with SSL or if you don't have valid SSL
        curl_setopt($Channel, CURLOPT_SSL_VERIFYPEER, $VerifyPeer);

        // Disable HOST (the site you are sending request to) SSL Verification,
        // if Host can have certificate which is nvalid / expired / not signed by authorized CA.
        curl_setopt($Channel, CURLOPT_SSL_VERIFYHOST, $VerifyHost);

        // Execute CURL command
        curl_exec($Channel);

        // Close the CURL channel
        curl_close($Channel);

        // Close file handle
        fclose($File);

        // return true if file download is successfull
        return (file_exists($ToLocation) && filesize($ToLocation) > 0);
    }

    public function actionTest($iter = 0){
        $shop = Shop::findOne(3);
        $time[0] = microtime(true);
        $params = $this->getParamArray($shop);

//            $prod = $this->getProductArray($shop);
        $time[1]= microtime(true);

        return $this->render('test',compact('params','iter','shop','time'));

    }

}
