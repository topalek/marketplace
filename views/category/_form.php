<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
$category = \app\models\Category::find()->all();
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <? //= $form->field($model, 'parent_id')->textInput() ?>
    <!--    --><? //= $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map($category,'category_id','name')) ?>
    <div class="col-xs-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-xs-6">
        <div class="form-group field-category-parent_id required has-success">
            <label class="control-label" for="category-parent_id">Parent ID</label>
            <select id="category-parent_id" class="form-control" name="Category[parent_id]">

                <? if (empty($category)) {
                    echo '<option value="0" selected>
                                самостоятельная категория
                            </option>';
                } else {
                    echo \app\components\MenuWidget::widget(['tpl' => 'select', 'model' => $category]);
                }

                ?>
            </select>
        </div>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'visible')->checkbox(['checked' => 'checked']) ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'order')->textInput() ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'category_slug')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
