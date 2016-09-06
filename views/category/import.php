<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


$this->title = 'импорт категорий магазина';
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?> </h1>

    <div class="col-xs-12">
        <div class="text-center">
            <div class="col-xs-6">
                <? $form = ActiveForm::begin() ?>
                <div class="col-xs-8">
                    <div class="form-group field-shopform-shop">
                        <select id="shopform-shop" class="form-control" name="shop">
                            <option <?php if (!$shop) echo 'selected' ?> value> -- Select Shop --</option>
                            <?php foreach (\yii\helpers\ArrayHelper::map($shops, 'name', 'shop_id') as $name => $id) : ?>
                                <option
                                    value="<?= $id ?>" <?php if ($shop->shop_id == $id) echo 'selected' ?>><?= $name ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <?= Html::submitInput('Load', ['class' => 'btn btn-success']) ?>
                </div>
                <? ActiveForm::end() ?>
            </div>
            <div class="col-xs-4">
                <div id="xml_url"></div>
            </div>
        </div>

    </div>

    <?php if ($category) : ?>
        <div class="col-sm-6">
            <h3> Импортировано <?= count($category) ?> категорий</h3>
        </div>

    <?php endif; ?>
    <div class="col-xs-12"><hr></div>

    <h2>импорт бретндов магазина </h2>
    <div class="col-xs-12">
        <div class="text-center">
            <div class="col-xs-6">
                <? $form = ActiveForm::begin() ?>
                <div class="col-xs-8">
                    <div class="form-group field-shopform-shop">
                        <select id="" class="form-control" name="brand">
                            <option <?php if (!$shop) echo 'selected' ?> value> -- Select Shop --</option>
                            <?php foreach (\yii\helpers\ArrayHelper::map($shops, 'name', 'shop_id') as $name => $id) : ?>
                                <option
                                    value="<?= $id ?>" <?php if ($shop->shop_id == $id) echo 'selected' ?>><?= $name ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <?= Html::submitInput('Load', ['class' => 'btn btn-success']) ?>
                </div>
                <? ActiveForm::end() ?>
            </div>
            <div class="col-xs-4">
                <div id="xml_url"></div>
            </div>
        </div>

    </div>

    <?php if ($count) : ?>
        <div class="col-sm-12">
            <h3> Импортировано <?= $count ?> категорий из <?= count($brands) ?></h3>
        </div>
        <pre>
            <?php print_r($brands); ?>
        </pre>

    <?php endif; ?>
    <div class="col-xs-12"><hr></div>

    <h2>импорт товаров магазина </h2>
    <div class="col-xs-12">
        <div class="text-center">
            <div class="col-xs-6">
                <? $form = ActiveForm::begin() ?>
                <div class="col-xs-8">
                    <div class="form-group field-shopform-shop">
                        <select id="-shop" class="form-control" name="product">
                            <option <?php if (!$shop) echo 'selected' ?> value> -- Select Shop --</option>
                            <?php foreach (\yii\helpers\ArrayHelper::map($shops, 'name', 'shop_id') as $name => $id) : ?>
                                <option
                                    value="<?= $id ?>" <?php if ($shop->shop_id == $id) echo 'selected' ?>><?= $name ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <?= Html::submitInput('Load', ['class' => 'btn btn-success']) ?>
                </div>
                <? ActiveForm::end() ?>
            </div>
            <div class="col-xs-4">
                <div id="xml_url"></div>
            </div>
        </div>

    </div>

    <?php if ($product) : ?>
        <div class="col-sm-12">
            <h3> Импортировано <?= count($product) ?> товаров</h3>
        </div>
        <!--<pre>
            <?php /*print_r($product); */?>
        </pre>-->

    <?php endif; ?>
    <script>
        var json = '';
        $('#shopform-shop').change(function () {
            var url = $(this).val();
            $('#xml_url').html(url);
        });

    </script>
</div>
