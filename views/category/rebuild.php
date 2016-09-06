<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;

$options = \app\components\MenuWidget::widget(['tpl'=> 'select','model'=> $model])
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    table-bordered-->
    <table class="table  table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Category ID</th>
            <th>Parent ID</th>
            <th>Name</th>
            <th>Visible</th>
            <th>Order</th>
            <th>Slug</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model as $item): ?>
            <tr>
                <th><?=++$i?></th>
                <td><?= $item['category_id'] ?>
                    <input type="hidden" name="category_id" value="<?= $item['category_id']?>">
                </td>
                <td>
                    <select class="form-control" name="parent_id">
                        <?php
                        $str = '<option value="'.$item['parent_id'].'">';
                            $option = str_replace($str,$str.' selected',$options);
                        ?>
                        <?= $option ?>
                    </select>
                </td>
                <td><input type="text" name="name" value="<?= $item['name']?>"></td>
                <td><input type="checkbox" name="visible" checked="<?= $item['visible']?>"></td>
                <td><input type="number" name="order" value="<?= $item['order']?>"></td>
                <td><input type="text" name="category_slug" value="<?= $item['category_slug']?>"></td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
        <div id="pagination">
            <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
        </div>
</div>
