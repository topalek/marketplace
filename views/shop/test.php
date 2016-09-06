<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $model app\models\Shop */

//$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Магазины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$time_update = explode('.',microtime(true));
?>
<div class="shop-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $brands = ArrayHelper::map(\app\models\Brand::find()->asArray()->indexBy('brand_id')->all(),'brand_id','name')?>

    <pre>
        <?= date('H:i:s',$time_update[0]).'.'.$time_update[1]?>
        <? print_r($time_update)?>

<!--        --><?php //$model = Product::updateAll(['status'=>0],'shop_id= :shop_id and time_update < :time_update',[':shop_id'=>3,':time_update'=>$time_update]); ?>
                <?php
                $prod = Product::getProducts(1);
                print_r($prod); ?>
        <?= count($prod)?>
<!--        --><?// print_r(array_keys($brands,'hot wheels')[0])?>
    </pre>


</div>
