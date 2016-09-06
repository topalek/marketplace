<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Product;


$this->title = 'импорт категорий магазина';
$start = explode('.',$time[0]);
$finish = explode('.',$time[1]);

?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?>  </h1>


    <h2> <?= date('h:i:s',$start[0]).'.'.$start[1]?>  Time to execute: <?=round($time[1]-$time[0],3)?>s.</h2>
    <div class="col-xs-12">
        <pre>

                <?php
//                print_r($params);
                $step = 1000*$iter;
                $fin = 999;
                if ($step+$fin > count($params)) $fin = count($params)- $step;

                for ($i=$step; $i<$step+$fin;$i++ ){
                    $xml_id = $params[$i][0]['prod_id'];
                    $prod_id = Product::find()->select('id')->where(['xml_id' => $xml_id, 'shop_id' => $shop->shop_id])->one();

                    if ($prod_id['id']) {
                        $prod_id = $prod_id['id'];

                        foreach ($params[$i] as $atr) {
                            $model = \app\models\Param::find()->where(['product_id' => $prod_id, 'name' => $atr['name']])->one();
                            if (!$model) {
                                $model = new \app\models\Param();
                                $model->name = $atr['name'];
                                $model->product_id = $prod_id;
                                if(!$model->save()) print_r($model->getErrors());

                                $param_id = $model->id;
                                $prop = new \app\models\ParamValue();
                                $prop->param_id = $param_id;
                                $prop->value = (string)$atr['val'];
                                if ($atr['unit']) $prop->unit = $atr['unit'];
                                if(!$prop->save()) print_r($prop->getErrors());

                            }
                        }
                    }
                }
                $iter++;
//                sleep(5);
                if ($step+$fin != count($params)) {
                    Yii::$app->response->redirect(\yii\helpers\Url::to(['/category/test','iter'=>$iter]));
                };

                ?>
<!--            <h3> продуктов --><?//= count($prod) ?><!-- </h3>-->
        </pre>
    </div>
    <h2> <?= 'finish - '.date('h:i:s',$finish[0]).'.'.$finish[1]?> </h2>

    <?php if ($params) : ?>
        <div class="col-sm-6">
<!--            <h3> Импортировано --><?//= count($params) ?><!-- </h3>-->
            <h3> Parametrov <?= count($params) ?> </h3></div>

    <?php endif; ?>

