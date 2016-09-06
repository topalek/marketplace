<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = 'Сопоставление Брендов';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$brands_m = \app\models\Brand::find()->asArray()->all();
$options = Html::dropDownList('brand', '', ArrayHelper::map($brands_m, 'brand_id', 'name'),['class' => 'form-control', 'prompt'=>'выберите бренд']);
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-md-12">
        <?php foreach ($brands as $k => $brand) : ?>
            <div class="item">
                <div class="col-md-5">
                    <div class="form-group field-category-name required">
                        <input type="text" class="form-control text-right" name="brand" value="<?= $brand ?>"
                               maxlength="255">
                    </div>
                </div>
                <div class="col-md-5">
                    <?  $option = $options;
                        if (strpos($option, $brand)) {
                            $pat = '/>('.$brand.')/';
                            $option = preg_replace($pat,'selected >'.$brand,$option);
//                            $model = new \app\models\Brand();
//                            $model->name = $brand;
//                            $model->save();
                        }
                        echo $option;
                    ?>
                </div>
                <div class="col-md-2">
                    <div class="form-group field-brand-name required">
                        <a href="#" class="btn btn-danger save"> save </a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
    <script>
        $('select').select2();
        $(function () {
            $('option[selected]').parents('select:not(#shopform-shop)').next('.select2').addClass('success');
        });
        $('.save').on('click',function (e) {
            e.preventDefault();
            var a = $(this);
            var name = a.parents('.item').find('input').val();
            var id = a.parents('.item').find('select').val() ? parseInt($(this).parents('.item').find('select').val()) : 0;
            $.post('/brand/save',{brand:[id,name]},function (res) {
                if (res == 'success') {
                    a.removeClass('btn-danger').addClass('btn-success').text('Saved');
                    a.closest('.item').find('.select2').addClass('success')
                }
            })

        })

    </script>

</div>
